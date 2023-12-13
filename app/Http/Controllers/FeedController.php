<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Category;
use App\Models\Feed;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();


        // $feeds = Feed::with('categories', 'supplier')
        //     ->orderBy('id', 'asc')
        //     ->get();

        return inertia('Feeds/index', [

            'supplier' => $suppliers,
            'categories' => $categories,
            'feeds' => Feed::query()
            ->with('categories', 'supplier')
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->orWhereHas('categories', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('supplier', function ($supplierQuery) use ($search) {
                    $supplierQuery->where('name', 'like', '%' . $search . '%');
                });
            })->paginate(8)
            ->withQueryString(),
            'filters' => HttpRequest::only(['search'])

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }


    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'cat_id' => [
                'required',
                Rule::unique('feeds')->where(function ($query) use ($request) {
                    return $query->where('sup_id', $request->sup_id);
                })->ignore($request->id),
            ],
            'sup_id' => 'required|numeric|exists:suppliers,id',
            'qty' => 'required|numeric',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect('/feeds')->withErrors($validator)->withInput()->with('error', 'Feeds already exist.');
        }

        // Create a new Feed
        $feed = Feed::create([
            'cat_id' => $request->cat_id,
            'sup_id' => $request->sup_id,
            'qty' => $request->qty,
            // Add other fields as needed
        ]);

        // Update or create the corresponding inventory record
        $inventory = Inventory::updateOrCreate(
            ['feed_id' => $feed->id],
            ['stock_in' => DB::raw('stock_in + ' . ($feed->qty ?? 0))]
        );

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created  a feeds item  with the id# " . $feed->id;
        event(new UserLog($log_entry));

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
        $feed->delete();
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " deleted  an feeds with the id# " . $feed->id;
        event(new UserLog($log_entry));
        return redirect('/feeds')->with('success', 'Feeds has been deleted successfully!');
    }
}
