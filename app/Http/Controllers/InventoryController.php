<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::with('feeds.categories', 'feeds.supplier')->paginate(6);

        $inventories->each(function ($inventory){
            $inventory->Available = $inventory->stock_out ? ($inventory->stock_in - $inventory->stock_out): $inventory->stock_in;
            if($inventory->feeds){
                $inventory->feeds_name = $inventory->feeds->categories->name;
            }else {
                $inventory->feeds_name = null;
            }
        });

        return Inertia('FeedsInventory/index',[
            'inventory' => $inventories
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
