<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Request as HttpRequest;
use App\Models\CashAdvance;
use App\Models\CashAdvanceTotals;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\PayrollItem;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Payroll/index', [
            'payroll' => Payroll::query()
                ->when(HttpRequest::input('search'), function ($query, $search) {
                    $query->where('payrollPeriodFrom', 'like', '%' . $search . '%')
                          ->orWhere('payrollPeriodTo', 'like', '%' . $search . '%');
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
        $employees = Employee::with('user', 'position', 'advanceTotal')
        ->whereHas('user', function ($query) {
            $query->where('status', 1); // Assuming 'status' is the field indicating the user's status
        })
        ->get();


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


    }

    public function show(Payroll $payroll)
    {
        $payroll->load('payrollItem.employee.user', 'payrollItem.employee.position', 'payrollItem.employee.advanceTotal' );

        // Convert the Eloquent model and related models to plain arrays
        $payrollArray = $payroll->toArray();
        $payrollArray['payrollItem'] = $payroll->payrollItem->map(function ($item) {
            return $item->toArray();
        });

        return inertia('Payroll/show', [
            'payroll' => $payrollArray,

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

    public function payroll(){
        $payroll = Payroll::with('payrollItem.employee.user', 'payrollItem.employee.position', 'payrollItem.employee.advanceTotal')
            ->orderByDesc('created_at')
            ->first(); // Retrieve only the most recent payroll

        // Check if a payroll was found before proceeding
        if ($payroll) {
            // Convert the Eloquent model and related models to plain arrays
            $payrollArray = $payroll->toArray();
            $payrollArray['payrollItem'] = $payroll->payrollItem->map(function ($item) {
                return $item->toArray();
            });

            return inertia('Payroll/payroll', [
                'payroll' => $payrollArray,
            ]);
        } else {
            // Handle the case where no recent payroll is found
            return inertia('Payroll/payroll', [
                'payroll' => null, // or any other default value or message
            ]);
        }
    }

}
