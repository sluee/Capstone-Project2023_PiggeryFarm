<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Category;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id')->get();
        return inertia('Feed/index',[
            'feeds' => Feed::with('category') // Load related data
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
        $fields=$request->validate([
            'name' => 'string|required',
            'description' => 'nullable',
            'cat_id'    =>'required'

        ]);

        Feed::create($fields);

        return redirect('/feeds')->with('message','Feeds Added Successfully');
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
        $fields = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'cat_id' => 'required'
        ]);

        $feed->update($fields);

        return redirect('/feeds')->with('message', 'Feed information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feed $feed)
    {
        $feed->delete();

        return redirect('/feeds')->with('message', 'Feed has been deleted successfully!');
    }
}
