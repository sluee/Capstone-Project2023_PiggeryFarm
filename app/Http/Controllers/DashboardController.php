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

        return inertia('Dashboard',[
            'sales' => $sales,
            'totalAmountAllSales' => $totalAmountAllSales,
            'monthlySales ' => $monthlySales,
            'employeeCount' => $employeeCount,
            'pigsCount' => $pigsCount,
            'currentMonthSales' => $currentMonthSales

        ]);
    }
}
