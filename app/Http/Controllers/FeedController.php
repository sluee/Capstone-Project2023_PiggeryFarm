<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use App\Models\Supplier;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        $supplier = Supplier::orderBy('id')->get();

        $feeds = Feed::with('categories', 'supplier')
            ->orderBy('id', 'asc')
            ->get();

        return inertia('Feeds/index', [
            'feeds' => $feeds,
            'supplier' => $supplier,
            'categories' => $categories,
        ]);



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
            'cat_id' => 'required|numeric|exists:categories,id',
            'qty'    => 'required',
            'sup_id' => 'required|numeric|exists:suppliers,id',
        ]);

        // Retrieve the associated category
        // $category = Category::find($fields['cat_id']);

        // if (!$category) {
        //     return redirect('/feeds')->with('error', 'Invalid Category');
        // }

        // // Calculate totalAmount using category price and feed quantity
        // $totalAmount = $category->price * $fields['qty'];

        // // Add totalAmount to the fields array
        // $fields['totalAmount'] = $totalAmount;

        // Create the Feed model with the calculated totalAmount
        Feed::create($fields);

        return redirect('/feeds')->with('success', 'Feeds Added Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed)
    {
        //
    }
}
