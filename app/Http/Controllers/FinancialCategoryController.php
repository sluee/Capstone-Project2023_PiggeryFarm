<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use Illuminate\Http\Request;

class FinancialCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financial = FinancialCategory::orderBy('id', 'asc')->get();
        return inertia('FinancialCategory/index', [
            'financial' => $financial
        ]);
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
        $fields=$request->validate([
            'particulars' => 'required',
        ]);

        FinancialCategory::create($fields);

        return redirect('/financial')->with('message','Particular Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialCategory $financialCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialCategory $financialCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialCategory $financialCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialCategory $financialCategory)
    {
        //
    }
}
