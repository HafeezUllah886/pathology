<?php

namespace App\Http\Controllers;

use App\Models\receipt_type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceiptTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = receipt_type::all();

        return view('types.types', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = receipt_type::where('type', $request->type)->count();
        if($check > 0)
        {
            return back()->with('error', 'Already Created');
        }
        receipt_type::create(
            [
                'type' => $request->type,
                'updatedBy' => auth()->user()->id
            ]
        );

        return back()->with('success', 'Receipt Type Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(receipt_type $receipt_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(receipt_type $receipt_type)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $check = receipt_type::where('type', $request->type)->where('id', '!=', $id)->count();
        if($check > 0)
        {
            return back()->with('error', 'Already Created');
        }

        $receipt = receipt_type::find($id);
        $receipt->update(
            [
            'type' => $request->type,
            'updatedBy' => auth()->user()->id
            ]
        );

        return back()->with('success', 'Receipt Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(receipt_type $receipt_type)
    {
        //
    }
}
