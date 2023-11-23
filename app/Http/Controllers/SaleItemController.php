<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index()
     {
        $monthlySales =DB::table('sales')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total_sales'))
        ->groupBy('year', 'month')
        ->get();
         $customers = Customer::orderBy('id')->get();

         $salesItems = SaleItem::with('sale') // Load related data
             ->orderBy('id', 'asc')
             ->get();

         // Calculate the total for each SaleItem and add it to the data

         return inertia('SalesItem/index', [
             'salesItems' => $salesItems,
             'customers' => $customers,
             'monthlySales' =>$monthlySales

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
    // public function store(Request $request)
    // {




    public function store(Request $request)
    {
        $fields = $request->validate([
            'cust_id' => 'required|exists:customers,id',
            'salesItems' => 'required|array|min:1',
            'salesItems.*.pig_weight' => 'required|numeric',
            'salesItems.*.rate' => 'required|numeric',
            // You may remove 'salesItems.*.total' from validation
        ]);

        // Create the Sale instance
        $sale = Sale::create([
            'cust_id' => $request->input('cust_id'),
            'total_amount' => 0, // Calculate 'total_amount' based on the associated SaleItems
            'is_credit' => $request->input('is_credit'),
            'payment' => $request->input('payment'),
            'balance' => $request->input('balance'),
            'remarks' => $request->input('remarks'),
            // Add any other relevant fields here
        ]);

        // Loop through the sales items and associate them with the sale
        foreach ($fields['salesItems'] as $itemData) {
            $total = $itemData['pig_weight'] * $itemData['rate'];
            $saleItem = new SaleItem([
                'pig_weight' => $itemData['pig_weight'],
                'rate' => $itemData['rate'],
                'total' => $total,
            ]);
            $sale->salesItems()->save($saleItem);
        }

        // Calculate the total amount for the sale based on associated SaleItems
        $sale->total_amount = $sale->salesItems->sum('total');
        $sale->save();

        return redirect('/sales/' .  $sale->id)->with('success', 'Sales Added Successfully');

    }



    /**
     * Display the specified resource.
     */

//     public function show(SaleItem $saleItem)
// {
//     $saleItem->load('sale'); // Load the parent Sale model for the SaleItem

//     return inertia('SalesItem/show', [
//         'saleItem' => $saleItem,
//         'sale' => $saleItem->sale, // Include the Sale model
//     ]);
// }


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
