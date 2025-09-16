<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use App\Models\receipt;
use App\Models\receipt_tests;
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

        $receipts = receipt::whereDate('entery_time', '>=', $from)->whereDate('entery_time', '<=', $to)->orderBy('id', 'desc')->get();

        return view('cashier.index', compact('receipts', 'from', 'to'));
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
    public function update(Request $request, receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(receipt $receipt)
    {
        //
    }

    
}
