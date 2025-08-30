<?php

namespace App\Http\Controllers;

use App\Models\Test_groups;
use App\Models\Test_values;
use Illuminate\Http\Request;

class TestValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $group = Test_groups::find($id);
        return view('tests.groups.values', compact('group'));
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
        $group = Test_groups::find($request->id);
        $group->values()->delete();

        $values = $request->name;
        foreach ($values as $key => $value) {   
            $value = Test_values::create([
                'test_group_id' => $group->id,
                'test_id' => $group->test_id,
                'name' => $value,
                'unit' => $request->unit[$key],
                'normal_range' => $request->normal_range[$key],
                'type' => $request->type[$key],
                'options' => array_map('trim', explode(',', $request->options[$key])),
        ]);
    }
    return redirect()->route('test_groups.index', ['id' => $group->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test_values $test_values)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test_values $test_values)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test_values $test_values)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test_values $test_values)
    {
        //
    }
}
