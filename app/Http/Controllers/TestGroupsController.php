<?php

namespace App\Http\Controllers;

use App\Models\Test_groups;
use App\Models\Tests;
use Illuminate\Http\Request;

class TestGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $test_groups = Test_groups::where('test_id', $request->id)->get();

        $test = Tests::find($request->id);
        return view('tests.groups.index', compact('test_groups', 'test'));
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
        $test_group = Test_groups::create([
            'test_id' => $request->id,
            'name' => $request->name,
        ]);
        return redirect()->route('test_groups.index', ['id' => $request->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test_groups $test_groups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test_groups $test_groups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test_groups $test_groups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test_groups $test_groups)
    {
        //
    }
}
