<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('FeedsSupplier/Index',[
            'suppliers' => Supplier::query()
            ->when(HttpRequest::input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
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
        // return inertia('FeedsSupplier/index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'name' => 'required',
            'phone' => 'required',

        ]);

        Supplier::create($fields);

        return redirect('/suppliers')->with('success','Suppliers Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Supplier $supplier)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $fields= $request->validate([
            'name' => 'required',
            'phone' => 'required',

        ]);

        $supplier->update($fields);

        return redirect('/suppliers')->with('success','Suppliers Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect('/suppliers')->with('success', 'Supplier has been deleted successfully!');
    }
}
