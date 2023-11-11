<?php

namespace App\Http\Controllers;

use App\Models\CashAdvanceTotals;
use App\Models\Payroll;
use App\Models\PayrollItem;
use Illuminate\Http\Request;

class PayrollItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'payrolls' => 'required|array',
            'payrolls.*.emp_id' => 'required|exists:employees,id',
            'payrolls.*.daysWorked' => 'required|numeric',
            'payrolls.*.overtimeHours' => 'nullable|numeric',
            'payrolls.*.overtimeAmount' => 'nullable|numeric',
            'payrolls.*.totalBasicPay' => 'nullable|numeric',
            'payrolls.*.grossAmount' => 'nullable|numeric',
            'payrolls.*.personalDeduction' => 'nullable|numeric',
            // 'payrolls.*.cashAdvanceId' => 'nullable|exists:cash_advances,id',
            'payrolls.*.totalDeductions' => 'nullable|numeric',
            'payrolls.*.netAmount' => 'required|numeric',
        ]);

         // Create the Sale instance
         $payroll = Payroll::create([
            'payrollPeriodFrom' => $request->input('payrollPeriodFrom'),
            'payrollPeriodTo' => $request->input('payrollPeriodTo'),
            'noOfDaysWorked' => $request->input('noOfDaysWorked'),
            'total_gross_amount' => $request->input('total_gross_amount'),
            'total_deductions_amount' => $request->input('total_deductions_amount'),
            'total_net_amount' => $request->input('total_net_amount'),
        ]);

        foreach ($data['payrolls'] as $payrollData) {
            $payrollItem = new PayrollItem([
                'emp_id' => $payrollData['emp_id'],
                'daysWorked' => $payrollData['daysWorked'],
                'overtimeHours' => $payrollData['overtimeHours'],
                'overtimeAmount' => $payrollData['overtimeAmount'],
                'totalBasicPay' => $payrollData['totalBasicPay'],
                'grossAmount' => $payrollData['grossAmount'],
                'personalDeduction' => $payrollData['personalDeduction'],
                'totalDeductions' => $payrollData['totalDeductions'],
                'netAmount' => $payrollData['netAmount'], 
            ]);
        
            $employeeTotal = CashAdvanceTotals::firstOrNew(['emp_id' => $payrollData['emp_id']]);
            $employeeTotal->totalCashAdvance -= $payrollData['totalDeductions'];
            $employeeTotal->save();
        
            $payroll->payrollItem()->save($payrollItem);
        }   

        return redirect('/payroll')->with('success', 'Payroll data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PayrollItem $payrollItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayrollItem $payrollItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PayrollItem $payrollItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayrollItem $payrollItem)
    {
        //
    }
}
