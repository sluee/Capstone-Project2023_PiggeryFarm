<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Feed;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        $feeds = Feed::orderBy('id')->get();
        $suppliers = Supplier::orderBy('id')->get();

        $inventories = Inventory::with('category', 'feed', 'supplier')->orderBy('id', 'asc')->get();
        return inertia('Inventory/index', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'feeds' => $feeds,
            'inventories' => $inventories,
        ]);

    }

    public function search($searchKey){
        return inertia('Inventory/index', [
            'inventories' => Inventory::where('qty', 'like' , "%$searchKey%")->orWhere('date_received', 'like' , "%$searchKey%")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $feeds = Feed::orderBy('id')->get();

        return inertia('Inventory/create', [
            'feeds' => $feeds,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'feed_id' => 'required',
            'qty' => 'required|integer',
            'date_received' => 'required|date',
            'costPerStocks' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);

        // Get the selected feed
        $feed = Feed::find($fields['feed_id']);

        // Populate sup_id with the supplier's id from the selected feed
        $fields['sup_id'] = $feed->category->supplier->id;

        // Populate cat_id with the category's id from the selected feed
        $fields['cat_id'] = $feed->category->id;

        // Calculate the total amount after discount
        $totalAmountAfterDiscount = ($fields['costPerStocks'] * $fields['qty']) - ($fields['discount'] * $fields['qty']);
        $fields['totalAmountAfterDiscount'] = $totalAmountAfterDiscount;

        Inventory::create($fields);

        return redirect('/inventories')->with('success','Item created successfully');
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
        $feeds = Feed::orderBy('id')->get();

        return inertia('Inventory/edit', [
            'feeds' => $feeds,
            'inventory' => $inventory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $fields = $request->validate([
            'feed_id' => 'required',
            'qty' => 'required|integer',
            'date_received' => 'required|date',
            'costPerStocks' => 'required|numeric',
            'discount' => 'required|numeric',
        ]);

        // Get the selected feed
        $feed = Feed::find($fields['feed_id']);

        // Populate sup_id with the supplier's id from the selected feed
        $fields['sup_id'] = $feed->category->supplier->id;

        // Populate cat_id with the category's id from the selected feed
        $fields['cat_id'] = $feed->category->id;

        // Calculate the total amount after discount
        $totalAmountAfterDiscount = ($fields['costPerStocks'] * $fields['qty']) - ($fields['discount'] * $fields['qty']);
        $fields['totalAmountAfterDiscount'] = $totalAmountAfterDiscount;

        $inventory->update($fields);

        return redirect('/inventories')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect('/inventories')->with('message', 'Item has been deleted successfully!');
    }
}
