<?php

namespace App\Http\Controllers;

use App\Models\Consumption;
use App\Models\FeedsPurchase;
use App\Models\Payroll;
use App\Models\Sale;
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

    // public function payrollHistory()
    // {
    //     $payrolls = Payroll::orderBy('id', 'desc')->get();
    //     $pdf = Pdf::loadView('Pdf.payroll-history', [
    //         'payroll' => $payrolls,

    //     ]);

    //     return $pdf->stream();
    // }

    public function payrollHistory(){
        $payrolls = Payroll::orderBy('id', 'desc')->get();

        $payrolls->each(function ($payroll) {
            $payroll->formattedPeriod = Carbon::parse($payroll->payrollPeriodFrom)->format('F d, Y') . ' - ' . Carbon::parse($payroll->payrollPeriodTo)->format('F d, Y');
            // Add other data as needed
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
            // Add other data as needed
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
            // Add other data as needed
        });
        $pdf = Pdf::loadView('Pdf.Consumption', [
            'consumption' => $consumption,
        ]);

        return $pdf->stream();
    }

}
