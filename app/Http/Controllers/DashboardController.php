<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $sales = Sale::with('salesItems', 'customers')
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Calculate the total weight and total pigs for each sale
        foreach ($sales as $sale) {
            $sale->totalWeight = $sale->salesItems->sum('pig_weight');
            $sale->totalPigs = $sale->salesItems->count();
        }
        $totalAmountAllSales = $sales->sum('total_amount');
        return inertia('Dashboard',[
            'sales' => $sales,
            'totalAmountAllSales' => $totalAmountAllSales
        ]);
    }
}
