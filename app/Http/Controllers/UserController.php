<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return inertia('User/index', [
            'users' => $users
        ]);
    }

    public function create(){
        $position = Position::all();
        return inertia('User/create', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'positions' => $position
        ]);
    }

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
            'type' => 'required',
            'password' => 'required',
            'role' => 'required', // Include 'role' in validation
        ]);
        
        $data['password'] = bcrypt($data['password']); // Hash the password

        unset($data['role']);
        $type = $data['type'];
        $role = $request->role;

        $user = User::create($data);

        $user->assignRole($role);

         if ($type === 'employee') {
            // Handle the ",employee" type here.
            $position = $request->input('pos_id');


            // Create a new employee associated with the user
            $employee = new Employee([
                'pos_id' => $position,
            ]);

            // Save the employee first to get an ID.
            $user->employee()->save($employee);

        }
        return redirect()->route('user.index');
    }

    public function edit(User $user){
        $user = User::with('roles')->find($user->id);
        
        // Fetch the associated Employee record and its related Position
        $employee = Employee::with('position')->where('user_id', $user->id)->first();
        $position = Position::all();
        $roles = Role::all();
        
        return inertia('User/edit', [
            'user' => $user,
            'roles' => $roles,
            'positions' => $position,
            'currentRole' => $user->roles->first()->name,
            'employee' => $employee
        ]);
    }
    

    public function update(Request $request, User $user){
        $data = $request->validate([
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'middleName' => 'nullable|string',
            'suffix' => 'nullable|string',
            'gender' => 'required|string',
            'address' => 'required|string',
            'type' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'password' => 'nullable|string',
            'role' => 'required',
        ]);

        // $data['password'] = bcrypt($data['password']); // Hash the password
        if (isset($data['password']) && $data['password'] !== null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Remove the "password" field from the data array
        }

        unset($data['role']);

        $role = $request->role;
      
        $user->update($data);

        $user->assignRole($role);

        return redirect()->route('user.index');
    }

    public function destroy(User $user) {
        $user->delete();

        return back();
    }
}
