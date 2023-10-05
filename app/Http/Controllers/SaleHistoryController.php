<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleHistory;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('id')->get();
        $sales = Sale::with('customers')->get();
        $salesItems = SaleItem::with('sale') // Load related data
            ->orderBy('id', 'asc')
            ->get();

        // Calculate the total for each SaleItem and add it to the data
        foreach ($salesItems as $saleItem) {
            $saleItem->total = $saleItem->getTotalAttribute(); // Assuming you have a getTotalAttribute method in your SaleItem model
        }

        // Calculate the total amount of all listed purchases
        $totalAmount = $salesItems->sum('total');

        return inertia('SalesHistory/index', [
            'salesItems' => $salesItems,
            'sales'=>$sales,
            'customers' => $customers,
            'totalAmount' => $totalAmount, // Pass the total amount to your view
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleHistory $saleHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleHistory $saleHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleHistory $saleHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleHistory $saleHistory)
    {
        //
    }
}
