<?php

namespace App\Http\Controllers;

use App\Models\charges;
use App\Http\Controllers\Controller;
use App\Models\receipt_type;
use Illuminate\Http\Request;

class ChargesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = receipt_type::all();
        $charges = charges::all();
        return view('charges.charges', compact('types', 'charges'));
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
        $check = charges::where('name', $request->name)->count();
        if($check > 0)
        {
            return back()->with('error', 'Already Created');
        }

        charges::create(
            [
                'name' => $request->name,
                'rate' => $request->rate,
                'typeID' => $request->typeID,
                'updatedBy' => auth()->user()->id,
            ]
        );

        return back()->with('success', "Charges Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(charges $charges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(charges $charges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $check = charges::where('name', $request->name)->where('id', '!=', $id)->count();
        if($check > 0)
        {
            return back()->with('error', 'Already Created');
        }

        $charges = charges::find($id);
        $charges->update(
            [
            'name' => $request->name,
                'rate' => $request->rate,
                'typeID' => $request->typeID,
                'updatedBy' => auth()->user()->id,
            ]
        );

        return back()->with('success', 'Charges Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(charges $charges)
    {
        //
    }

    public function getcharges($id)
    {
        $charges = charges::find($id);
        return $charges;
    }
}
