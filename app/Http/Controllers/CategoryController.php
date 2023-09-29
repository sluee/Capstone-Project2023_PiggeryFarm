<?php

namespace App\Http\Controllers;

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
        $suppliers = Supplier::orderBy('id')->get();
        return inertia('FeedsCategory/index',[
            'categories' => Category::with('supplier') // Load related data
            ->orderBy('id', 'asc')
            ->get(),
            'suppliers' =>$suppliers

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
            'sup_id'    =>'required'

        ]);

        Category::create($fields);

        return redirect('/categories')->with('message','Suppliers Added Successfully');
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
        $fields = $request->validate([
            'sup_id' => 'required',
            'name' => 'string|required',
            'description' => 'string|required',
        ]);

        $category->update($fields);

        return redirect('/categories')->with('message', 'Category information has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories')->with('message', 'Category has been deleted successfully!');
    }
}
