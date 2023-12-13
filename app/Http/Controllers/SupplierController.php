<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

       $sup= Supplier::create($fields);

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created a feeds supplier  with the id# " . $sup->id;
        event(new UserLog($log_entry));

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
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " updated a feeds supplier  with the id# " . $supplier->id;
        event(new UserLog($log_entry));

        return redirect('/suppliers')->with('success','Suppliers Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " deleted a feeds supplier  with the id# " . $supplier->id;
        event(new UserLog($log_entry));

        return redirect('/suppliers')->with('success', 'Supplier has been deleted successfully!');
    }
}
