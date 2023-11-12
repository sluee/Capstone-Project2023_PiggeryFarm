<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
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
}
