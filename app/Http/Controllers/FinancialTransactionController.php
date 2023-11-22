<?php

namespace App\Http\Controllers;

use App\Models\FinancialCategory;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\FinancialTransaction;
use App\Models\FinancialTransactionItems;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FinancialTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Transactions/index', [
            'transactions' => FinancialTransaction::query()
                ->with('financialItems')
                ->when(HttpRequest::input('search'), function ($query, $search) {
                    $query->where('payrollPeriodFrom', 'like', '%' . $search . '%');
                        //   ->orWhere('payrollPeriodTo', 'like', '%' . $search . '%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(7)
                ->withQueryString(),
            'filters' => HttpRequest::only(['search'])
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return inertia('Transactions/create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'particulars' => 'required|array',
            'particulars.*.fin_id' => 'required|string',
            'particulars.*.debit' => 'nullable|numeric',
            'particulars.*.credit' => 'nullable|numeric',
            'particulars.*.balance' => 'nullable|numeric',
        ]);

        $transaction = FinancialTransaction::create([
            'date' => $request->input('date'),
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

        return redirect('/transactions/' . $transaction->id)->with('success', 'Financial Transaction Added Successfully');
    }





    /**
     * Display the specified resource.
     */
    public function show(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->load('financialItems');

        // Convert the Eloquent model and related models to plain arrays
        $financialTransactionArray = $financialTransaction->toArray();
        $financialTransactionArray['financialItems'] = $financialTransaction->financialItems->map(function ($item) {
            return $item->toArray();
        });

        return inertia('Transactions/show', [
            'transaction' => $financialTransactionArray,
        ]);
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialTransaction $financialTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialTransaction $financialTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialTransaction $financialTransaction)
    {
        //
    }

    public function chart(){
        return Inertia('Transactions/chart');
    }

    public function financial(){

        $financialTransaction = FinancialTransaction::with('financialItems')
        ->orderByDesc('date')
        ->first(); // Retrieve only the most recent transaction

    // Check if a transaction was found before proceeding
    if ($financialTransaction) {
        // Convert the Eloquent model and related models to plain arrays
        $financialTransactionArray = $financialTransaction->toArray();
        $financialTransactionArray['financialItems'] = $financialTransaction->financialItems->map(function ($item) {
            return $item->toArray();
        });

        return inertia('Transactions/financial', [
            'transaction' => $financialTransactionArray,
        ]);
    } else {
        // Handle the case where no recent transaction is found
        return inertia('Transactions/financial', [
            'transaction' => null, // or any other default value or message
        ]);
    }


    }
}
