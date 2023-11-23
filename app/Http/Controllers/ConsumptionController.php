<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Consumption;
use App\Models\Feed;
use App\Models\Inventory;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FeedsConsumption/index', [
            'consumption' => Consumption::query()
                ->with('feeds.categories', 'feeds.supplier')
                ->when(request()->input('search'), function ($query, $search) {
                    $query->where('date', 'like', '%' . $search . '%')
                          ->orWhere('qty', 'like', '%' . $search . '%')
                          ->orWhereHas('feeds.categories', function ($categoryQuery) use ($search) {
                              $categoryQuery->where('name', 'like', '%' . $search . '%');
                          })
                          ->orWhereHas('feeds.supplier', function ($supplierQuery) use ($search) {
                              $supplierQuery->where('name', 'like', '%' . $search . '%');
                          });
                })
                ->orderBy('id', 'desc')
                ->paginate(6)
                ->withQueryString(),
            'feeds' => Feed::with('categories', 'supplier')->orderBy('id', 'asc')->get(),
            'filters' => request()->only(['search'])
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
        $fields = $request->validate([
            'feed_id' => 'required|numeric|exists:feeds,id',
            'qty'    => 'required|numeric|min:1',
            'date' =>'required'
        ]);

       
        $feed = Feed::with('categories')->findOrFail($fields['feed_id']);

        // Check if the consumption quantity is greater than the available feed quantity
        if ($fields['qty'] > $feed->qty) {
            return redirect('/feeds-consumption')->with('error', 'Error: Consumption quantity exceeds available feed quantity');
        }

        // Create the FeedPurchase model with the calculated totalAmount
        $cons = Consumption::create($fields);

        // $newStock = $feed->qty - $fields['qty'];
        // $feed->update(['qty' => $newStock]);
        $feed->decrement('qty', $fields['qty']);

        $inventory = Inventory::where('feed_id' ,$cons->feed_id)->first();
        if($inventory){
            $inventory->stock_out += $cons->qty;
            $inventory->save();
        } 
           

        return redirect('/feeds-consumption')->with('success', 'Feeds Purchase Added Successfully');
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
        //
    }
}
