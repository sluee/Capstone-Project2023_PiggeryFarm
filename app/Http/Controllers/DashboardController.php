<?php

namespace App\Http\Controllers;

use App\Models\Boar;
use App\Models\Employee;
use App\Models\Sale;
use App\Models\Sow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $monthlySales = Sale::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"), DB::raw('SUM(total_amount) as total_sales'))
        ->groupBy('month')
        ->get();

        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        // Fetch sales for the current month
        $sales = Sale::with('salesItems', 'customers')
            ->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Calculate the total weight and total pigs for each sale
        foreach ($sales as $sale) {
            $sale->totalWeight = $sale->salesItems->sum('pig_weight');
            $sale->totalPigs = $sale->salesItems->count();
        }

        // Calculate the total sales for the current month
        $totalAmountAllSales = $sales->sum('total_amount');

        // Optionally, you can get the year and month for reference
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $employeeCount = Employee::count();
        $pigsCount = Sow::count() + Boar::count();

        // $currentMonth = now()->month;
        $currentMonthSales = DB::table('sales')
        ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total_sales'))
        ->groupBy('year', 'month')
        ->whereMonth('created_at', now()->month)
        ->get();
        // return response()->json($currentMonthSales);

           // Retrieve sales data for the previous month
            $previousMonthSales = Sale::select(DB::raw('SUM(total_amount) as total_sales'))
            ->whereYear('created_at', now()->subMonth()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->first();

        // Calculate the percentage change
        $percentageChange = 0; // Default value if there are no previous month sales
        if ($previousMonthSales && $previousMonthSales->total_sales != 0) {
            $percentageChange = (($totalAmountAllSales - $previousMonthSales->total_sales) / $previousMonthSales->total_sales) * 100;
        }
        return inertia('Dashboard',[
            'sales' => $sales,
            'totalAmountAllSales' => $totalAmountAllSales,
            'monthlySales ' => $monthlySales,
            'employeeCount' => $employeeCount,
            'pigsCount' => $pigsCount,
            'currentMonthSales' => $currentMonthSales,
            'percentageChange' => $percentageChange

        ]);
    }
}
