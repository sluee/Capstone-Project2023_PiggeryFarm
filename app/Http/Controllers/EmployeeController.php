<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Employee/index', [
            'employees' => Employee::query()
                ->with('user', 'position')
                ->when(request()->input('search'), function ($query, $search) {
                    $query->where(function ($subquery) use ($search) {
                        $subquery->whereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('firstName', 'like', '%' . $search . '%')
                                       ->orWhere('lastName', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('position', function ($positionQuery) use ($search) {
                            $positionQuery->where('position', 'like', '%' . $search . '%');
                        });
                    });
                })
                ->paginate(7)
                ->withQueryString(),
            'filters' => request()->only(['search']),
        ]);

        // $employees = Employee::with('user', 'position')->get();
        // return Inertia('Employee/index',[
        //     'employees' => $employees
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $position = Position::all();
        $roles = Role::whereIn('name', ['employee', 'specialEmployee'])->get();


        return Inertia('Employee/create',[
            'position' =>$position,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'firstName' => 'required',
            'middleName' => 'nullable',
            'lastName' => 'required',
            'suffix' => 'nullable',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'type' => 'employee',
            'password' => 'required',
            'role' => 'required', // Include 'role' in validation
        ]);
        unset($data['role']);
        $role = $request->role;

        $user = User::create($data);

        $user->assignRole($role);

        $employee = new Employee([
            'pos_id' => $request->input('pos_id'),
        ]);

        $user->employee()->save($employee);

        return redirect('/employees')->with('message', 'Employee successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return Inertia('Employee/show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $position = Position::all();
        $roleNames = ['employee', 'specialEmployee'];
        $roles = Role::whereIn('name', $roleNames)->get();
        return Inertia('Employee/edit',[
            'position' => $position,
            'employee' => $employee->load('user.roles'),
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $user = $employee->user;
        $user->update([
            'firstName' => $request->input('firstName'),
            'middleName' => $request->input('middleName'),
            'lastName' => $request->input('lastName'),
            'suffix' => $request->input('suffix'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'status' => $request->input('status'),
        ]);

        // Update employee details
        $employee->update([
            'pos_id' => $request->input('pos_id'),
            'status' => $request->input('status'),
        ]);


        return redirect('/employees')->with('message', 'Employee information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect('/employees')->with('message', 'Employee has been deleted successfully!');
    }
}
