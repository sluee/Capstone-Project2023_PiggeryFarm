<?php

namespace App\Http\Controllers;

use App\Models\FinancialTransaction;
use App\Models\FinancialTransactionItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FinancialTransactionItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $yearlyFinancial = DB::table('financial_transactions')
            ->select(DB::raw('YEAR(date) as year'), DB::raw('SUM(totalCashBalance) as totalCashBalance'))
            ->groupBy('year')
            ->get();

        $currentYear = now()->year; // Get the current year

        $monthlyFinancial = FinancialTransaction::whereYear('date', $currentYear)
            ->selectRaw('MONTH(date) as month, SUM(totalCashBalance) as totalCashBalance')
            ->groupByRaw('MONTH(date)')
            ->get();

        // Log the results for debugging
        Log::info($monthlyFinancial);

        return inertia('Transactions/chart', [
            'monthlyFinancial' => $monthlyFinancial,
            'currentYear' => $currentYear,
            'yearlyFinancial' => $yearlyFinancial
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
        $data = $request->validate([
            'particulars' => 'required|array',
            'particulars.*.fin_id' => 'required|exists:financial_categories,id',
            'particulars.*.debit' => 'nullable|numeric',
            'particulars.*.credit' => 'nullable|numeric',
            'particulars.*.balance' => 'nullable|numeric',
        ]);

        $transaction = FinancialTransaction::create([
            'totalCashBalance' => $request->input('totalCashBalance'),
            'remarks' => $request->input('remarks'),
        ]);

        $transactionItems = [];

        foreach ($data['particulars'] as $particularData) {
            $transactionItems[] = new FinancialTransactionItems([
                'fin_id' => $particularData['fin_id'],
                'debit' => $particularData['debit'],
                'credit' => $particularData['credit'],
                'balance' => $particularData['balance'],
            ]);
        }

        $transaction->financialItems()->saveMany($transactionItems);

        return redirect('/transactions')->with('success', 'Financial Transaction Added Successfully');
    }





    /**
     * Display the specified resource.
     */
    public function show(FinancialTransactionItems $financialTransactionItems)
    {
        $financialTransactionItems->load('financialTransactionItems');

        // Convert the Eloquent model and related models to plain arrays
        // $payrollArray = $payroll->toArray();
        // $payrollArray['payrollItem'] = $payroll->payrollItem->map(function ($item) {
        //     return $item->toArray();
        // });

        return inertia('Transactions/show', [
            'transaction' => $financialTransactionItems,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialTransactionItems $financialTransactionItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialTransactionItems $financialTransactionItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialTransactionItems $financialTransactionItems)
    {
        //
    }
}
