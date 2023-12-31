<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Feed;
use App\Models\FeedsPurchase;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedsPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FeedsPurchase/index', [
            'feedsPurchase' => FeedsPurchase::query()
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



        // $feeds = Feed::with('categories', 'supplier')
        //     ->orderBy('id', 'asc')
        //     ->get();

        // $feedsPurchase = FeedsPurchase::with('feeds.categories', 'feeds.supplier')->get();

        // return inertia('FeedsPurchase/index', [
        //     'feedsPurchase' => $feedsPurchase,
        //     'feeds' => $feeds,

        // ]);
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
        $fields = $request->validate([
            'feed_id' => 'required|numeric|exists:feeds,id',
            'qty'     => 'required',
            'date'    => 'required',
        ]);

        // Wrap the database operations in a transaction
        DB::transaction(function () use ($fields) {
            // Retrieve the associated feed with the category loaded
            $feed = Feed::with('categories')->findOrFail($fields['feed_id']);

            // Calculate totalAmount using category price and feed quantity
            $totalAmount = $feed->categories->price * $fields['qty'];

            // Add totalAmount to the fields array
            $fields['totalAmount'] = $totalAmount;

            // Create the FeedPurchase model with the calculated totalAmount
            $purchase= FeedsPurchase::create($fields);

            // Increment the qty field of the Feed model
            $feed->increment('qty', $fields['qty']);

            // Update or create the Inventory model
            $inventory = Inventory::where('feed_id', $feed->id)->first();
            if ($inventory) {
                $inventory->stock_in += $fields['qty'];
                $inventory->save();
            } else {
                $inventory = new Inventory([
                    'feed_id'  => $feed->id,
                    'stock_in' => $fields['qty'],
                ]);
                $inventory->save();
            }
            $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created  a feeds purchase item  with the id# " . $purchase->id;
            event(new UserLog($log_entry));
        });

        return redirect('/feeds-purchase')->with('success', 'Feeds Purchase Added Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(FeedsPurchase $feedsPurchase)
    {

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeedsPurchase $feedsPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeedsPurchase $feedsPurchase)
    {
        $fields = $request->validate([
            'feed_id' => 'required|numeric|exists:feeds,id',
            'qty'     => 'required|numeric',
            'date'    => 'required',
        ]);

        // Check existence of the $feedsPurchase model
        if (!$feedsPurchase) {
            return abort(404); // Or handle the case appropriately
        }

        // Retrieve the associated feed with the category loaded
        $feed = Feed::with('categories')->findOrFail($fields['feed_id']);

        // Calculate totalAmount using category price and feed quantity
        $totalAmount = $feed->categories->price * $fields['qty'];

        // Add totalAmount to the fields array
        $fields['totalAmount'] = $totalAmount;

        // Update the FeedPurchase model with the calculated totalAmount
        $feedsPurchase->update($fields);

        // Update the feed quantity
        $newStock = $feed->qty + $fields['qty'];
        $feed->update(['qty' => $newStock]);

        return redirect('/feeds-purchase')->with('success', 'Feeds Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeedsPurchase $feedsPurchase)
    {
        $feedsPurchase->delete();

        return redirect('/feeds-purchase')->with('success', 'Feeds Purchase has been deleted successfully!');
    }
}
