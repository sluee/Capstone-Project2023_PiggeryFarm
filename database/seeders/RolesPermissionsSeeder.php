<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\View;
class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $role_admin = Role::create(['name' => 'admin']);
        $role_employee = Role::create(['name' => 'employee']);
        $role_specialEmployee = Role::create(['name' => 'specialEmployee']);
        $role_owner = Role::create(['name' => 'owner']);


        $manage_pig = Permission::create(['name' => 'manage_pigs']);
        $manage_feeds = Permission::create(['name' => 'manage_feeds']);
        $manage_users = Permission::create(['name' =>'manage_users']);
        $read_employee = Permission::create(['name' =>'read_users']);
        $manage_financial = Permission::create (['name' =>'manage_finance']);
        $permission_read = Permission::create(['name' => 'read_invoice']);
        $manage_invoice = Permission::create(['name' =>'manage_invoice']);
        $permission_create = Permission::create(['name' => 'create_invoice']);
        $permission_edit = Permission::create(['name' => 'edit_invoice']);
        $permission_delete = Permission::create(['name' => 'delete_invoice']);
        $permission_view = Permission::create(['name' => 'view_invoice']);
        $manage_payroll   = Permission::create (['name' =>'manage_payroll']);
        $read_payroll = Permission::create (['name' => 'read_payslip']);
        $manage_report = Permission::create (['name'=> 'manage_reports']);

        $permission_admin = [$manage_feeds, $manage_report,$manage_financial, $manage_pig, $manage_invoice, $read_employee, $manage_users, $permission_edit, $permission_delete,$permission_read,$manage_payroll, $permission_view];
        $permission_employee = [$read_payroll];
        $permission_specialEmployee = [$manage_feeds, $manage_pig, $manage_invoice, $permission_create,$read_payroll, $permission_view];
        $permission_owner =[$manage_report, $read_employee, $permission_read, $permission_view];

        $role_admin->syncPermissions($permission_admin);
        $role_employee->syncPermissions($permission_employee);
        $role_specialEmployee->syncPermissions($permission_specialEmployee);
        $role_owner->syncPermissions($permission_owner);

        User::find(1)->assignRole($role_admin);
        User::find(2)->assignRole($role_employee);
        User::find(3)->assignRole($role_specialEmployee);
        User::find(4)->assignRole($role_owner);

        // Retrieve the "employee" and "specialEmployee" roles and pass their IDs to the view
        $employeeRole = Role::where('name', 'employee')->first();
        $specialEmployeeRole = Role::where('name', 'specialEmployee')->first();

        View::share([
            'employeeRoleId' => $employeeRole ? $employeeRole->id : null,
            'specialEmployeeRoleId' => $specialEmployeeRole ? $specialEmployeeRole->id : null,
        ]);
    }

}

