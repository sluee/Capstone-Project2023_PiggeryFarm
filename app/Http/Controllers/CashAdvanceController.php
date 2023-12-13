<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\CashAdvance;
use App\Models\CashAdvanceTotals;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashAdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cashAdvance = CashAdvance::with('employee.user')
            ->orderBy('id', 'desc')
            ->paginate(6);

        $cashAdvanceTotal = CashAdvanceTotals::with('employee.user')
            ->paginate(6);

        return inertia('CashAdvance/index', [
            'cashAdvance' => $cashAdvance,
            'cashAdvanceTotal' => $cashAdvanceTotal,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employee::with('user')
        ->whereHas('user', function ($query) {
            $query->where('status', 1); // Assuming 'status' is the field indicating the user's status
        })
        ->get();

        return inertia('CashAdvance/create', [
            'cashAdvance' => CashAdvance::orderBy('id', 'asc')->get(),
            'employee' => $employee
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {


        $employeeId = $request->input('emp_id');
        $amount = $request->input('amount');
        $requestDate = $request->input('requestDate');
        $reason = $request->input('reason');

        // Find or create the associated EmployeeCashAdvanceTotal record
        $employeeTotal = CashAdvanceTotals::firstOrNew(['emp_id' => $employeeId]);
        $employeeTotal->totalCashAdvance += $amount; // Add the new cash advance amount
        $employeeTotal->save();

        // Create a new cash advance record
        $newCashAdvance = new CashAdvance;
        $newCashAdvance->emp_id = $employeeId;
        $newCashAdvance->amount = $amount;
        $newCashAdvance->reason = $reason;
        $newCashAdvance->requestDate = $requestDate;


        // Save the EmployeeCashAdvanceTotal record
        $employeeTotal->save();

        // Set the total_advance_id for the CashAdvance record
        $newCashAdvance->cash_id = $employeeTotal->id;

        // Save the new cash advance record
        $newCashAdvance->save();

        $log_entry = Auth::user()->firstName . " ". Auth::user()->lastName . " created a cash advance for " . $newCashAdvance->employee->user->firstName . $newCashAdvance->employee->user->lastName . " with the id# " . $newCashAdvance->id;
        event(new UserLog($log_entry));

        return redirect('/cashAdvance')->with('success', 'Cash Advance Added Successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(CashAdvance $cashAdvance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CashAdvance $cashAdvance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CashAdvance $cashAdvance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CashAdvance $cashAdvance)
    {
        //
    }
}
