<?php

namespace App\Http\Controllers;

use App\Models\Boar;
use App\Models\Breeding;
use App\Models\CashAdvanceTotals;
use App\Models\Consumption;
use App\Models\Employee;
use App\Models\FeedsPurchase;
use App\Models\FinancialTransaction;
use App\Models\Inventory;
use App\Models\Labor;
use App\Models\Payroll;
use App\Models\Sale;
use App\Models\Sow;
use App\Models\Weaning;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function salesReceipt(Sale $sale){
        $sale->load('salesItems', 'customers');
        $totalPigs = $sale->salesItems->count();
        $totalWeight = $sale->salesItems->sum('pig_weight');
        // $formattedCreatedAt = $sale->created_at->diffForHumans();

        $pdf = Pdf::loadView('Pdf.sales-summary',[
            'sale'=>$sale,
            'totalPigs' =>$totalPigs,
            'totalWeight' =>$totalWeight,
            // 'formattedCreatedAt' => $formattedCreatedAt
        ]);

        return $pdf->stream();
    }

    public function payrollSummary( Payroll $payroll){
        $payroll->load('payrollItem.employee.user', 'payrollItem.employee.position', 'payrollItem.employee.advanceTotal' );
        $formattedDates = $payroll->formatted_created_at;
        $pdf = Pdf::loadView('Pdf.payroll-summary',[
            'payroll'=>$payroll,
            'formattedDates' =>$formattedDates

        ]);

        return $pdf->stream();
    }

    public function payrollHistory(){
        $payrolls = Payroll::orderBy('id', 'desc')->get();

        $payrolls->each(function ($payroll) {
            $payroll->formattedPeriod = Carbon::parse($payroll->payrollPeriodFrom)->format('F d, Y') . ' - ' . Carbon::parse($payroll->payrollPeriodTo)->format('F d, Y');
        });

        $pdf = Pdf::loadView('Pdf.payroll-history', [
            'payroll' => $payrolls,
        ]);

        return $pdf->stream();
    }

    public function feedsPurchase(){
        $feedsPurchase = FeedsPurchase::with('feeds.categories', 'feeds.supplier')->orderBy('id', 'desc')->get();
        $feedsPurchase->each(function ($purchase) {
            $purchase->formattedPeriod = Carbon::parse($purchase->date)->format('F d, Y');
        });
        $pdf = Pdf::loadView('Pdf.feeds-purchase', [
            'feedsPurchase' => $feedsPurchase,
        ]);

        return $pdf->stream();
    }


    public function feedsConsumption(){
        $consumption = Consumption::with('feeds.categories', 'feeds.supplier')->orderBy('id', 'desc')->get();
        $consumption->each(function ($purchase) {
            $purchase->formattedPeriod = Carbon::parse($purchase->date)->format('F d, Y');
        });
        $pdf = Pdf::loadView('Pdf.Consumption', [
            'consumption' => $consumption,
        ]);
        return $pdf->stream();
    }


    public function sows(){
        $sow = Sow::orderBy('id', 'desc')->get();
        $sow->each(function ($sow) {
            $sow->formattedDate = Carbon::parse($sow->date_arrived)->format('F d, Y');

        });
        $pdf = Pdf::loadView('Pdf.Sow', [
            'sow' => $sow,
        ]);

        return $pdf->stream();
    }

    //For Boars
    public function boars(){
        $boar = Boar::orderBy('id', 'desc')->get();
        $boar->each(function ($boar) {
            $boar->formattedDate = Carbon::parse($boar->date_arrived)->format('F d, Y');

        });
        $pdf = Pdf::loadView('Pdf.Boar', [
            'boar' => $boar,
        ]);

        return $pdf->stream();
    }

    public function breedings(){
        $breeding = Breeding::with('sow', 'boar')->orderBy('id', 'desc')->get();
        $breeding->each(function ($breeding) {
            $breeding->formattedBreed = Carbon::parse($breeding->date_of_breed)->format('F d, Y');
            $breeding->formattedReheat = Carbon::parse($breeding->possible_reheat)->format('F d, Y');
            $breeding->formattedFeeds = Carbon::parse($breeding->changeFeeds)->format('F d, Y');
            $breeding->formattedFarrowing = Carbon::parse($breeding->exp_date_of_farrowing)->format('F d, Y');

        });
        $pdf = Pdf::loadView('Pdf.Breeding', [
            'breeding' => $breeding,
        ]);
        return $pdf->stream();
    }

    public function labors(){
        $labor = Labor::with('breeding.sow', 'breeding.boar')->orderBy('id', 'desc')->get();
        $labor->each(function ($labor) {
            $labor->formattedFarrow = Carbon::parse($labor->actual_date_farrowing)->format('F d, Y');
            $labor->formattedWeaning = Carbon::parse($labor->date_of_weaning)->format('F d, Y');
        });
        $pdf = Pdf::loadView('Pdf.Labor', [
            'labor' => $labor,
        ]);
        return $pdf->stream();
    }

    public function weanings(){
        $weaning = Weaning::with('labors.breeding.sow', 'labors.breeding.boar')->orderBy('id', 'desc')->get();
        // $weaning->each(function ($weaning) {
        //     $weaning->formattedFarrow = Carbon::parse($weaning->actual_date_farrowing)->format('F d, Y');
        //     $weaning->formattedWeaning = Carbon::parse($weaning->date_of_weaning)->format('F d, Y');
        // });
        $pdf = Pdf::loadView('Pdf.Weaning', [
            'weaning' => $weaning,
        ]);
        return $pdf->stream();
    }


    public function transaction(FinancialTransaction $financialTransaction){
        $financialTransaction->load('financialItems');
        $financialTransaction->formattedDate = Carbon::parse($financialTransaction->created_at)->format('F Y');
        $pdf = Pdf::loadView('Pdf.transaction-summary',[
            'transactions'=>$financialTransaction,

        ]);

        return $pdf->stream();
    }

    public function employeeSummary(){
        $employee = Employee::with('user', 'position')->get();
        $pdf = Pdf::loadView('Pdf.employeeSummary', [
            'employee' => $employee,
        ]);

        return $pdf->stream();
    }

    public function cashAdvance(){
        $cashAdvanceTotal =CashAdvanceTotals::with('employee.user')->get();
        $pdf = Pdf::loadView('Pdf.cashAdvanceTotals', [
            'cashAdvanceTotal' => $cashAdvanceTotal,
        ]);

        return $pdf->stream();
    }

    public function transactionSummary(){
        $transactions = FinancialTransaction::get();
        $pdf = Pdf::loadView('Pdf.transaction', [
            'transaction' => $transactions,
        ]);

        return $pdf->stream();
    }

    public function inventorySummary(){
        $inventory = Inventory::get();
        
        $inventory->each(function ($item) {
            $item->Available = $item->stock_out ? ($item->stock_in - $item->stock_out) : $item->stock_in;
    
            if ($item->feeds) {
                $item->feeds_name = $item->feeds->categories->name;
            } else {
                $item->feeds_name = null;
            }
        });
    
        $pdf = Pdf::loadView('Pdf.inventory', [
            'inventory' => $inventory,
        ]);

        return $pdf->stream();

    }

    public function financialLatest()
    {
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

        $pdf = Pdf::loadView('Pdf.LatestFinancial', [
            'transactions' => $financialTransaction,
        ]);
    
        return $pdf->stream();
    } else {
        // Handle the case where no recent transaction is found
        // return inertia('Transactions/financial', [
        //     'transaction' => null, // or any other default value or message
        // ]);
    }
    
        // $pdf = Pdf::loadView('Pdf.LatestFinancial', [
        //     'transactions' => $financialTransaction,
        // ]);
    
        // return $pdf->stream();
    }
    
}
