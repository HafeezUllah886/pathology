<?php

namespace App\Http\Controllers;

use App\Models\Tests;
use App\Models\Test_groups;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $tests = Tests::where('test_groups_id', $request->id)->get();

        $group = Test_groups::find($request->id);
        return view('groups.tests.index', compact('tests', 'group'));
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
            'name' => 'required | unique:tests,name',
            'status' => 'required',
        ]);
        Tests::create($request->all());
        return redirect()->back()->with('success', 'Test created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tests $tests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tests $tests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required | unique:tests,name,' . $id,
            'status' => 'required',
        ]);
        Tests::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Test updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tests $tests)
    {
        //
    }
}
