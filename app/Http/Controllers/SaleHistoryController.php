<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleHistory;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $monthlySales = DB::table('sales')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total_sales'))
        ->groupBy('year', 'month')
        ->get();


        // Handle the case where no recent transaction is found
        return inertia('SalesHistory/chart', [
            'monthlySales' => $monthlySales, // or any other default value or message
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
