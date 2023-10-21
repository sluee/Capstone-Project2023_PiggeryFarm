<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia('SalesItem/index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        // Load the related salesItems and the parent Customer model if needed
        $sale->load('salesItems', 'customers');

        // Calculate and store the totalPigs and totalWeight
        $totalPigs = $sale->salesItems->count();
        $totalWeight = $sale->salesItems->sum('pig_weight');

        // Pass the Sale model and the calculated values to the Inertia view
        return inertia('SalesItem/show', [
            'sale' => $sale,
            'totalPigs' => $totalPigs,
            'totalWeight' => $totalWeight, // Format the total weight
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
