<?php

namespace App\Http\Controllers;

use App\Models\Consumption;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('category', 'feed', 'supplier')->orderBy('id', 'asc')->get();

        return inertia('FeedsConsumption/index', [
            'consumptions' => Consumption::with('inventory.feed') // Include feed data
                ->orderBy('id', 'asc')
                ->get(),
            'inventories' => $inventories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories = Inventory::with('category', 'feed', 'supplier')->orderBy('id', 'asc')->get();

        return inertia('FeedsConsumption/create', [
            'consumptions' => Consumption::with('inventory.feed') // Include feed data
                ->orderBy('id', 'asc')
                ->get(),
            'inventories' => $inventories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'inventory_id' => 'required',
            'qtyConsumed' => 'required|integer',
            'date_consumed' => 'required|date',
        ]);

        Consumption::create($fields);

        return redirect('/consumptions')->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumption $consumption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumption $consumption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumption $consumption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumption $consumption)
    {
        $consumption->delete();

        return redirect('/consumptions')->with('message', 'Item has been deleted successfully!');
    }
}
