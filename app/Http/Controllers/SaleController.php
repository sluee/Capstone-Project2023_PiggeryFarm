<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('id')->get();
        return inertia('Sales/index', [
            'sales' => Sale::with('customers') // Load related data
                ->orderBy('id', 'asc')
                ->get(),
            'customers' =>$customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('id', 'asc')->get();

        return inertia('Sales/create',[
            'sales' =>Sale::orderBy('id','asc'),
            'customers'    =>$customers

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'cust_id'               => 'required|numeric',
            'pen_no'                => 'required|numeric',
            'pig_weight'            => 'required',
            'rate'                  => 'required'
            // 'total_amount'          =>'required',
            // 'payment'               => 'required_if:total_amount > 0',
            // 'balance'               => 'required_if:total_amount > 0',

        ]);

        Sale::create($fields);

        return redirect('/sales')->with('success', 'Pig Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
