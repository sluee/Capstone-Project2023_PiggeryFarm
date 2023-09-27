<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return inertia('Feeds/index',[
            'feeds' => Feed::with('categories')
            ->orderBy('id', 'asc')
            ->get(),
            'categories' =>$categories
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
            'cat_id'                => 'required|numeric',
            'name'               => 'required',
        ]);

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
