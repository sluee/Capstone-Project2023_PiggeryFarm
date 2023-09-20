<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Customer/index',[
            'customers' => Customer::orderBy('id')->get(),

        ]);
    }


    public function search($searchKey){
        return inertia('Customer/index', [
            'customers' => Customer::where('name', 'like' , "%$searchKey%")->orWhere('address', 'like' , "%$searchKey%")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Customer/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields=$request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|min:10|max:11',

        ]);

        Customer::create($fields);

        return redirect('/customers')->with('message','Customer Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
