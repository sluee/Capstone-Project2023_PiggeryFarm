<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return inertia('FeedsCategory/index',[
        //     'categories' => Category::orderBy('id', 'asc')
        //     ->get(),


        // ]);

        return inertia('FeedsCategory/index',[
            'categories' => Category::query()
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'name' => 'required',
            'description' => 'required',
            'price'    =>'required'

        ]);

        Category::create($fields);

        return redirect('/categories')->with('success','Feeds Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $fields=$request->validate([
            'name' => 'required',
            'description' => 'required',
            'price'    =>'required'

        ]);

        $category->update($fields);

        return redirect('/categories')->with('success','Feeds Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories')->with('success', 'Category has been deleted successfully!');
    }
}
