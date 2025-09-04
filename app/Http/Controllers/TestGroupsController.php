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
    public function index()
    {
        $groups = Test_groups::all();

        return view('groups.index', compact('groups'));
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
        $request->validate([
            'name' => 'required|unique:test_groups,name',
        ]);
        $test_group = Test_groups::create([
            'name' => $request->name,
        ]);
        return redirect()->route('test_groups.index');
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:test_groups,name,'.$id,
        ]);
        $test_group = Test_groups::find($id);
        $test_group->name = $request->name;
        $test_group->save();
        return redirect()->route('test_groups.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test_groups $test_groups)
    {
        //
    }
}
