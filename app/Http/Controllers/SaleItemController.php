<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('id')->get();
        return inertia('SalesItem/index', [
            'saleItem' => SaleItem::with('customers,sales') // Load related data
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
        // $sales = Sale::orderBy('cust_id', 'asc')->get();
        // $customers = Customer::orderBy('id', 'asc')->get();
        // // dd($customers);
        // return inertia('SalesItem/create',[
        //     'saleItem' =>SaleItem::orderBy('id','asc'),
        //     'sales'    =>$sales,
        //     'customers'  =>$customers,

        // ]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sales = Sale::orderBy('cust_id', 'asc')->get();
         $customers = Customer::orderBy('id', 'asc')->get();
        $validatedData = $request->validate([
            'sale_id' => 'required|exists:customers,id',
            'pen_no'    =>'required',
            'pig_weight'    =>'required',
            'rate'      =>'required'
            // Add validation rules for other fields (pen_no, pig_weight, rate) here
        ]);

        $sale = Sale::create([
            'sale_id' => $validatedData['sale_id'],
            // Add other fields as needed
        ]);

        foreach ($request->sale_items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id, // Associate the sale item with the sale
                'pen_no' => $item['pen_no'],
                'pig_weight' => $item['pig_weight'],
                'rate' => $item['rate'],
                // Add other fields as needed
            ]);
        }

        return redirect('/sales')->with('success', 'pig Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleItem $saleItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleItem $saleItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleItem $saleItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItem $saleItem)
    {
        //
    }
}
