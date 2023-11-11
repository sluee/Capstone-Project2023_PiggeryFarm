<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\CashAdvanceTotals;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $employees = Employee::with('user', 'position', 'cash_advance')->get();
        // $payroll = Payroll::with('employee.user', 'employee.position', 'employee.cash_advance')->get();
        // $payroll = Payroll::orderBy('id')->get();
        $payroll = Payroll::with('payrollItem', 'employee.user','employee.position', 'employee.cash_advance')
        ->orderBy('created_at', 'desc')
        ->get();
        return inertia('Payroll/index',[
            'payroll' => $payroll

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('user', 'position' , 'advanceTotal')->get();

        // Assuming you have a relationship between Employee and CashAdvance
        $cashAdvances = CashAdvanceTotals::whereIn('emp_id', $employees->pluck('id'))->get();

        return inertia('Payroll/create', [
            'employees' => $employees,
            'cashAdvances' => $cashAdvances
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'payrolls' => 'required|array',
            'payrolls.*.emp_id' => 'required|exists:employees,id',
            'payrolls.*.payrollPeriod' => 'required',
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

        foreach ($data['payrolls'] as $payrollData) {
            Payroll::create($payrollData);
        }
        return redirect('/payroll')->with('success', 'Payroll data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        $payroll->load('payrollItem.employee.user', 'employee.position', 'employee.cash_advance');
        // $payrollItem = PayrollItem::with('employee.user')->find($payroll->id);
        // Pass the Payroll model and the loaded relationships to the Inertia view
        return inertia('Payroll/show', [
            'payroll' => $payroll,
            // 'payrollItem' =>$payrollItem
            // Other data...
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        //
    }
}
