<?php

namespace App\Http\Controllers;

use App\Models\CashAdvance;
use App\Models\Employee;
use Illuminate\Http\Request;

class CashAdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cashAdvance = CashAdvance::with('employees.user')->get();


        return inertia('CashAdvance/index', [
            'cashAdvance' => $cashAdvance,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = Employee::with('user')->get();

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
        $fields = $request->validate([
            'emp_id'                => 'required|numeric',
            'requestDate'           => 'required|date',
            'amount'            => 'required',
            'status'       => 'required',

        ]);

        CashAdvance::create($fields);

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
