<?php

namespace App\Http\Controllers;

use App\Models\Boar;
use App\Models\Breeding;
use App\Models\Consumption;
use App\Models\FeedsPurchase;
use App\Models\FinancialTransaction;
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
}
