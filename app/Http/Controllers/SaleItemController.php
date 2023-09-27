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
            'salesItem' => SaleItem::with('sale') // Load related data
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

        $request->validate([
            'cust_id' => 'required|exists:customers,id',
            'salesItems' => 'required|array|min:1', // Ensure at least one sales item
            'salesItems.*.pen_no' => 'required|numeric',
            'salesItems.*.pig_weight' => 'required|numeric',
            'salesItems.*.rate' => 'required|numeric',
        ]);

        $sale = Sale::create([
            'cust_id' => $request->input('cust_id'),
            // Add any other relevant fields here
        ]);

        // Loop through the sales items and associate them with the sale
        $salesItems = $request->input('salesItems');

        if (!is_null($salesItems)) {
            foreach ($salesItems as $salesItemData) {
                $sale->salesItems()->create([
                    'pen_no' => $salesItemData['pen_no'],
                    'pig_weight' => $salesItemData['pig_weight'],
                    'rate' => $salesItemData['rate'],
                    // Add any other relevant fields here
                ]);
            }
        } else {
            // Handle the case where 'salesItems' is null
            // You can log an error, return a response, or perform other appropriate actions.
        }



        return redirect('/sales')->with('success', 'sales Added Successfully');
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
