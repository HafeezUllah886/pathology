<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\receipt as ModelsReceipt;
use App\Models\receipt_tests;
use App\Models\receipt_tests_parameters;
use App\Models\Test_parameters;
use Exception;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    public function index(Request $request)
    {

        $status = $request->status ?? "pending";
        $from = $request->from ?? firstDayOfMonth();
        $to = $request->to ?? lastDayOfMonth();
        $receipts = Receipt::where('status', $status)->whereDate('entery_time', '>=', $from)->whereDate('entery_time', '<=', $to)->orderBy('id', 'desc')->get();
        return view('reporting.index', compact('receipts', 'from', 'to', 'status'));
    }

    public function tests($id)
    {
        $tests = receipt_tests::where('receipt_id', $id)->get();
        $receipt = Receipt::find($id);
        
        return view('reporting.tests', compact('tests', 'receipt'));
    }

    public function parameters($id)
    {
        $test = receipt_tests::find($id);
        $parameters = Test_parameters::where('tests_id', $test->test_id)->get();

        return view('reporting.result_entry', compact('test', 'parameters'));
    }

    public function store(Request $request)
    {
        try
        {
            if($request->isNotFilled('parameter_id'))
            {
                throw new Exception('Please Add Atleast One Parameter');
            }

            DB::beginTransaction();

            $receipt_test = receipt_tests::find($request->receipt_test_id);

            $ids = $request->parameter_id;
            
            foreach ($ids as $key => $id) {
                $parameter = Test_parameters::find($id);
                receipt_tests_parameters::create([
                    'receipt_test_id' => $receipt_test->id,
                    'test_parameter_id' => $id,
                    'name' => $parameter->title,
                    'value' => $request->result[$key],
                    'is_heading' => $parameter->type == 'Heading' ? 'yes' : 'no',
                    'unit' => $parameter->unit,
                    'normal_range' => $parameter->normal_range,
                ]);
            }

            $receipt_test->update([
                'notes' => $request->notes,
                'result_entered_by' => auth()->user()->id,
                'result_entered_at' => now(),
            ]);
            
            
            DB::commit();
            return to_route('reporting.tests.index', ['id' => $request->receipt_id])->with('success', 'Report Added Successfully');
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function print_filter($id)
    {
        $receipt = Receipt::find($id);

        return view('reporting.printing.index', compact('receipt'));
    }

    public function print(Request $request)
    {
        if($request->isNotFilled('tests'))
        {
            return redirect()->back()->with('error', 'Please Select Atleast One Test');
        }
        $tests = receipt_tests::whereIn('id', $request->tests)->get();
        $receipt = Receipt::find($request->receipt_id);

       if($request->type == 1)
       {
        return view('reporting.printing.print', compact('tests', 'receipt'));
       }
       else
       {
        return view('reporting.printing.print_without_header', compact('tests', 'receipt'));
       }
    }
}
