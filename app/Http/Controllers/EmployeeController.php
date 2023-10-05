<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with('user', 'position')->get();
        return Inertia('Employee/index',[
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $position = Position::all();
        return Inertia('Employee/create',[
            'position' =>$position
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'firstName' =>$request->input('firstName'),
            'middleName' =>$request->input('middleName'),
            'lastName' =>$request->input('lastName'),
            'suffix' =>$request->input('suffix'),
            'gender' =>$request->input('gender'),
            'phone' =>$request->input('phone'),
            'address' =>$request->input('address'),
            'email' =>$request->input('email'),
            'password' =>$request->input('password'),
        ]);
        $user->save();

        $employee = new Employee([
            'pos_id' =>$request->input('pos_id')
        ]);

        $employee->status =1;

        $user->employee()->save($employee);

        return redirect('/employees')->with('message', 'Category successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
