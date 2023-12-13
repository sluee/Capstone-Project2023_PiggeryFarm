<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\CashAdvanceTotals;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'payrolls.*.cashAdvance' => 'required|nullable',
            'payrolls.*.totalDeductions' => 'nullable|numeric',
            'payrolls.*.netAmount' => 'required|numeric',
        ]);


        $request->validate([
            'payrollPeriodFrom' => 'required|date',
            'payrollPeriodTo' => 'required|date|after:payrollPeriodFrom',
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
                'cashAdvance' => $payrollData['cashAdvance'],
                'totalDeductions' => $payrollData['totalDeductions'],

                'netAmount' => $payrollData['netAmount'],
            ]);

            $employeeTotal = CashAdvanceTotals::firstOrNew(['emp_id' => $payrollData['emp_id']]);
            $employeeTotal->totalCashAdvance -= $payrollData['personalDeduction'];
            $employeeTotal->save();

            $payroll->payrollItem()->save($payrollItem);
        }
        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created  a payroll item  with the id# " . $payroll->id;
        event(new UserLog($log_entry));


        return redirect('/payroll/'.  $payroll->id)->with('success', 'Payroll data saved successfully');
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

    // public function showMyPayroll()
    // {

    //     $employeeId = auth()->user()->employee->id;
    //     $employee = Employee::where('id', $employeeId)->with('user', 'position')->first();
    //     $payroll = PayrollItem::with(['employee.user', 'employee.position','payroll'])
    //         ->where('emp_id', $employeeId)
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(1);

    //     return inertia('Payroll/payslip', [
    //         'payrollItem' => $payroll,
    //         'employee' => $employee,
    //     ]);
    // }

    // public function showMyPayroll()
    // {
    //     $employeeId = auth()->user()->employee->id;

    //     // Retrieve the employee information
    //     $employee = Employee::where('id', $employeeId)->with('user', 'position')->first();

    //     // Retrieve the most recent payroll item for the employee
    //     $payroll = PayrollItem::with(['employee.user', 'employee.position', 'payroll'])
    //         ->where('emp_id', $employeeId)
    //         ->latest('created_at') // Order by created_at in descending order
    //         ->first(); // Retrieve only the most recent item

    //         $payrollItem = $payroll->payroll;

    //     return inertia('Payroll/payslip', [
    //         'payrollItem' => $payroll,
    //         'employee' => $employee,
    //         'payroll'   => $payrollItem
    //     ]);
    // }

    public function showMyPayroll()
{
    $employeeId = auth()->user()->employee->id;

    // Retrieve the employee information
    $employee = Employee::where('id', $employeeId)->with('user', 'position')->first();

    // Retrieve the most recent payroll item for the employee
    $payrollItem = PayrollItem::with(['employee.user', 'employee.position', 'payroll'])
        ->where('emp_id', $employeeId)
        ->latest('created_at') // Order by created_at in descending order
        ->first(); // Retrieve only the most recent item



    return inertia('Payroll/payslip', [
        'payrollItem' => $payrollItem,
        'employee' => $employee,

    ]);
}


}
