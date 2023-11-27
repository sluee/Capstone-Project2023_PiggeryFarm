<?php

namespace App\Http\Controllers;

use App\Models\Boar;
use App\Models\Breeding;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Labor;
use App\Models\Sale;
use App\Models\Sow;
use App\Models\Weaning;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

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


        $employeeCount = Employee::count();
        $pigsCount = Sow::count() + Boar::count();

        // $currentMonth = now()->month;
        $currentMonthSales = DB::table('sales')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_amount) as total_sales'))
            ->groupBy('year', 'month')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
        // return response()->json($currentMonthSales);

           // Retrieve sales data for the previous month
            $previousMonthSales = Sale::select(DB::raw('SUM(total_amount) as total_sales'))
            ->whereYear('created_at', now()->subYear()->year)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->first();

        // Calculate the percentage change
        $percentageChange = 0; // Default value if there are no previous month sales
        if ($previousMonthSales && $previousMonthSales->total_sales != 0) {
            $percentageChange = (($totalAmountAllSales - $previousMonthSales->total_sales) / $previousMonthSales->total_sales) * 100;
        }

        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        // Count breeding records for the current month
        $breedingCounts = Breeding::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->whereIn('remarks', ['Reheat', 'Abort', 'Laboring'])
        ->selectRaw('remarks, count(*) as count')
        ->groupBy('remarks')
        ->get();

    // Extract counts for each remark
        $breedingCountReheat = $breedingCounts->firstWhere('remarks', 'Reheat')->count ?? 0;
        $breedingCountLabor = $breedingCounts->firstWhere('remarks', 'Laboring')->count ?? 0;
        $breedingCountAbort = $breedingCounts->firstWhere('remarks', 'Abort')->count ?? 0;

        // Count all breeding records for the current month
        $breedingCountTotal = Breeding::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
        // Count labor records for the current month
        $laborCount = Labor::whereMonth('created_at', $month)->whereYear('created_at', $year)->count() ?? 0;
        $totalNoPigsAlive = Labor::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->sum('no_pigs_alive');

        // Count weaning records for the current month
        $weaningCount = Weaning::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        $totalNoPigsWeaned = Weaning::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->sum('no_of_pigs_weaned');

        $stockInSum = Inventory::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
       
        ->sum('stock_in') ??0;
      

        return inertia('Dashboard',[
            'sales' => $sales,
            'totalAmountAllSales' => $totalAmountAllSales,
             // 'monthlySales ' => $monthlySales,
            'employeeCount' => $employeeCount,
            'pigsCount' => $pigsCount,
            'currentMonthSales' => $currentMonthSales,
            'percentageChange' => $percentageChange,
            'breedingCountReheat' =>$breedingCountReheat,
            'breedingCountAbort' =>$breedingCountAbort,
            'breedingCountLabor' =>$breedingCountLabor,
            'breedingCountTotal'=>$breedingCountTotal,
            'laborCount' => $laborCount,
            'totalNoPigsAlive'=> $totalNoPigsAlive,
            'weaningCount' => $weaningCount,
            'totalNoPigsWeaned' => $totalNoPigsWeaned,
            'stockInSum' => $stockInSum

        ]);
    }
}
