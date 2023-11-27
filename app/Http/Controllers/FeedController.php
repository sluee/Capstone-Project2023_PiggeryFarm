<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Category;
use App\Models\Feed;
use App\Models\Inventory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $fields = $request->validate([
    //         'cat_id' => 'required|numeric|exists:categories,id',
    //         'sup_id'    => 'required|numeric|exists:suppliers,id',

    //     ]);

    //     Feed::create($fields);

    //     return redirect('/feeds')->with('success', 'Feeds Added Successfully');
    // }
    // public function store(Request $request)
    // {
    //     $fields = $request->validate([
    //         'cat_id' => 'required|numeric|exists:categories,id',
    //         'sup_id' => 'required|numeric|exists:suppliers,id',
    //         // Add a unique rule for the combination of cat_id and sup_id
    //         'cat_id' => Rule::unique('feeds')->where(function ($query) use ($request) {
    //             return $query->where('sup_id', $request->sup_id);
    //         })->ignore($request->id), // Add this line if you're updating a record
    //     ]);

    //     $feed = Feed::create($fields);

    //     $inventory = Inventory::where('feed_id' ,$feed->id)->first();
    //     if($inventory){
    //         $inventory->stock_in += $feed->qty;
    //         $inventory->save();
    //     }else{
    //         $inventory = new Inventory([
    //             'feed_id'  => $feed->id,
    //             'stock_in'  => $feed->qty
    //         ]);
    //         $inventory->save();
    //     }

    //     return redirect('/feeds')->with('success', 'Feeds Added Successfully');
    // }
    public function store(Request $request)
{
    $fields = $request->validate([
        'cat_id' => 'required|numeric|exists:categories,id',
        'sup_id' => 'required|numeric|exists:suppliers,id',
        // Add a unique rule for the combination of cat_id and sup_id
        'cat_id' => Rule::unique('feeds')->where(function ($query) use ($request) {
            return $query->where('sup_id', $request->sup_id);
        })->ignore($request->id), // Add this line if you're updating a record
    ]);

    $feed = Feed::create($fields);

    $inventory = Inventory::where('feed_id' ,$feed->id)->first();
    if($inventory){
        $inventory->stock_in += $feed->qty;
        $inventory->save();
    } else {
        $inventory = new Inventory([
            'feed_id'  => $feed->id,
            'stock_in'  => $feed->qty
        ]);
        $inventory->save();
    }

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

        return redirect('/feeds')->with('success', 'Feeds has been deleted successfully!');
    }
}
