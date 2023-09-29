<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FeedsSupplier/index',[
            'suppliers' => Supplier::orderBy('id')->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return inertia('FeedsSupplier/index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'name' => 'string|required',
            'phone' => 'required|integer'
        ]);

        Supplier::create($fields);

        return redirect('/suppliers')->with('message','Suppliers Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $fields = $request->validate([
            'name' => 'string|required',
            'phone' => 'required|integer',
        ]);

        $supplier->update($fields);

        return redirect('/suppliers')->with('message', 'Supplier information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/suppliers')->with('message', 'Supplier has been deleted successfully!');
    }
}
