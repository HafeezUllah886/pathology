<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\receipt_tests;
use App\Models\Test_parameters;

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
        dd($request->all());
    }
}
