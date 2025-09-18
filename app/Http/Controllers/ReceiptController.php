<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use App\Models\receipt;
use App\Models\receipt_tests;
use App\Models\receipt_tests_parameters;
use App\Models\Tests;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from = $request->from ?? date('Y-m-d');
        $to =  $request->to ?? date('Y-m-d');
        $accounts = accounts::business()->get();

        $receipts = receipt::whereDate('entery_time', '>=', $from)->whereDate('entery_time', '<=', $to)->orderBy('id', 'desc')->get();

        return view('cashier.index', compact('receipts', 'from', 'to', 'accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $tests = Tests::active()->get();
        $accounts = accounts::business()->get();
        return view('cashier.create_receipt', compact('tests', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try
       {
            if($request->isNotFilled('id'))
            {
                throw new Exception('Please Select Atleast One Test');
            }

            DB::beginTransaction();

            $ref = getRef();
            $receipt = receipt::create([
                'patient_name'      => $request->patient_name,
                'patient_age'       => $request->patient_age,
                'patient_gender'    => $request->patient_gender,
                'patient_contact'   => '+92'.$request->patient_contact,
                'refered_by'        => $request->refered_by,
                'entery_time'       => $request->entery_time,
                'reporting_time'    => $request->reporting_time,
                'entered_by'        => auth()->user()->id,
                'discount'          => $request->discount,
                'paid_in'           => $request->paid_in,
                'refID'             => $ref,
                'notes'             => $request->notes,
            ]);

            $ids = $request->id;

            $total = 0;

            foreach($ids as $key => $id)
            {
                $test = Tests::find($id);

                $total += $request->rate[$key];
                receipt_tests::create([
                    'receipt_id' => $receipt->id,
                    'test_id' => $id,
                    'price' => $request->rate[$key],
                    'reporting_time' => $test->report_time,
                    'refID' => $ref,
                ]);
            }

            $net = $total - $request->discount;

            $receipt->update(
                [
                    'amount'        => $total,
                    'net_amount'    => $net,
                ]
            );

            $user = auth()->user()->name;

            $notes = "Receipt Created By $user for Patient $request->patient_name Lab ID # $receipt->id";

            createTransaction($request->paid_in, now(), $net, 0, $notes, $ref);

            DB::commit();

            return to_route('receipts.show', $receipt->id);
       }
       catch(Exception $e)
       {
         DB::rollBack();
           return back()->with('error', $e->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $receipt = receipt::find($id);

        return view('cashier.receipt_print', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $receipt = receipt::find($id);

        $tests = Tests::active()->get();
        $accounts = accounts::business()->get();
        return view('cashier.edit_receipt', compact('tests', 'accounts', 'receipt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try
        {
             if($request->isNotFilled('id'))
             {
                 throw new Exception('Please Select Atleast One Test');
             }
 
             DB::beginTransaction();
 
            // Update receipt details
            $receipt = receipt::findOrFail($id);
            $receipt->update([
                'patient_name'      => $request->patient_name,
                'patient_age'       => $request->patient_age,
                'patient_gender'    => $request->patient_gender,
                'patient_contact'   => $request->patient_contact,
                'refered_by'        => $request->refered_by,
                'entery_time'       => $request->entery_time,
                'reporting_time'    => $request->reporting_time,
                'discount'          => $request->discount,
                'paid_in'           => $request->paid_in,
                'notes'             => $request->notes,
            ]);

            // Get existing test IDs for this receipt
            $existingTests = $receipt->receipt_tests()->with('parameters')->get();
            $existingTestIds = $existingTests->pluck('test_id')->toArray();
            
            // Get submitted test IDs and their rates
            // The edit form posts hidden inputs as name="id[]" for test IDs
            $submittedTestIds = $request->input('id', []);
            $rates = $request->input('rate', []);
            
            // Process removed tests
            $removedTests = $existingTests->whereNotIn('test_id', $submittedTestIds);
            foreach ($removedTests as $test) {
                // Delete related parameters first
                $test->parameters()->delete();
                // Then delete the test
                $test->delete();
            }
            
            // Process existing and new tests
            foreach ($submittedTestIds as $index => $testId) {

                $test_info = Tests::find($testId);
                $testData = [
                    'test_id' => $testId,
                    'price' => $rates[$index] ?? 0, // Use submitted rate or default to 0
                    'reporting_time' => $test_info->report_time,
                    'refID' => $receipt->refID,
                ];
                
                // Check if test already exists in this receipt
                $existingTest = $receipt->receipt_tests()->where('test_id', $testId)->first();
                
                if ($existingTest) {
                    // Update existing test
                    $existingTest->update($testData);
                } else {
                    // Add new test
                    $receipt->receipt_tests()->create($testData);
                }
            }
            
            // Recalculate totals
            $total = $receipt->receipt_tests()->sum('price');
            $net = $total - $request->discount;
            
            // Update receipt with new totals
            $receipt->update([
                'amount' => $total,
                'net_amount' => $net,
            ]);
            
            $user = auth()->user()->name;
            $notes = "Receipt Updated By $user for Patient $request->patient_name Lab ID # $receipt->id";
            
            createTransaction($request->paid_in, now(), $net, 0, $notes, $receipt->refID);
            
            DB::commit();
            
            return to_route('receipts.index')->with('success', 'Receipt Updated Successfully');
    }
        catch(Exception $e)
        {
          DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(Request $request)
    {
        try
        {
            $receipt = receipt::find($request->receipt_id);
            DB::beginTransaction();
            $receipt->update([
                'status' => 'cancelled',
                'cancel_reason' => $request->reason,
            ]);

            $user = auth()->user()->name;
            $notes = "Receipt Cancelled By $user for Patient $receipt->patient_name Lab ID # $receipt->id";

            createTransaction($request->account, now(), 0, $receipt->amount, $notes, $receipt->refID);
            DB::commit();
            return to_route('receipts.index')->with('success', 'Receipt Cancelled Successfully');
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    
}
