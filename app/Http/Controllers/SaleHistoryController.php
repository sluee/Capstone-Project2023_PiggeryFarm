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
        $monthlySales =DB::table('sales')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_amount) as total_sales'))
        ->groupBy('year', 'month')
        ->when(HttpRequest::input('search'), function ($query, $search) {
            $query->where('remarks', 'like', '%' . $search . '%')
                ->orWhere('no_of_pigs_weaned', 'like', '%' . $search . '%')
                ->orWhereHas('labors.breeding.sow', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('sow_no', 'like', '%' . $search . '%');
                })
                ->orWhereHas('labors.breeding.boar', function ($supplierQuery) use ($search) {
                    $supplierQuery->where('breed', 'like', '%' . $search . '%');
                });
        })
        ->paginate(8)
        ->withQueryString();

        return inertia('SalesHistory/chart', [
            'monthlySales' => $monthlySales,
            'filters' => HttpRequest::only(['search']),
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
