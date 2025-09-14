<?php

namespace App\Http\Controllers;

use App\Models\Tests;
use App\Models\Test_groups;
use App\Models\Test_parameters;
use App\Models\units;
use Illuminate\Http\Request;

class TestParametersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $test = Tests::find($id);
        $parameters = test_parameters::where('tests_id', $id)->orderBy('sort', 'asc')->get();
        $units = units::orderBy('name', 'asc')->get();
        return view('groups.tests.parameters', compact('test', 'parameters', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $test = Tests::find($request->id);
        $test->parameters()->delete();

        $values = $request->name;
        foreach ($values as $key => $value) {   
            $value = Test_parameters::create([
                'tests_id' => $test->id,
                'sort' => $request->sort[$key],
                'title' => $value,
                'unit' => $request->unit[$key],
                'normal_range' => $request->normal_range[$key],
                'type' => $request->type[$key],
                'options' => array_map('trim', explode(',', $request->options[$key])),
        ]);
    }

    $test->remarks = array_map('trim', explode(',', $request->remarks));
    $test->save();
    return redirect()->route('tests.index', ['id' => $test->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test_parameters $test_values)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test_parameters $test_values)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test_parameters $test_values)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test_parameters $test_values)
    {
        //
    }
}
