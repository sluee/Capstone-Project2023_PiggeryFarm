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
        // $read_financial = Permission::create (['name' =>'read_finance']);
        $permission_read = Permission::create(['name' => 'read_invoice']);
        $manage_invoice = Permission::create(['name' =>'manage_invoice']);
        $permission_create = Permission::create(['name' => 'create_invoice']);
        $permission_edit = Permission::create(['name' => 'edit_invoice']);
        $permission_delete = Permission::create(['name' => 'delete_invoice']);
        $permission_view = Permission::create(['name' => 'view_invoice']);
        $manage_payroll   = Permission::create (['name' =>'manage_payroll']);
        $read_payroll = Permission::create (['name' => 'read_payslip']);
        $manage_report = Permission::create (['name'=> 'manage_reports']);
        $add_employee = Permission::create (['name'=> 'add_employee']);
        $delete_employee = Permission::create (['name'=> 'delete_employee']);
        $edit_employee = Permission::create (['name'=> 'edit_employee']);
        $delete_transaction = Permission::create (['name'=> 'delete_transaction']);
        $manage_sales = Permission::create (['name'=> 'manage_sales']);
        $add_customer = Permission::create (['name'=> 'add_customer']);
        $delete_customer = Permission::create (['name'=> 'delete_customer']);
        $edit_customer = Permission::create (['name'=> 'edit_customer']);
        $add_sales = Permission::create (['name'=> 'add_sales']);
        $delete_sales = Permission::create (['name'=> 'delete_sales']);
        $view_sales = Permission::create (['name'=> 'view_sales']);

        $permission_admin = [$manage_sales,$manage_feeds,$manage_financial,$add_employee,$delete_employee,$add_sales, $edit_employee ,$delete_customer, $edit_customer,$delete_transaction, $view_sales ,$add_customer,$delete_sales, $manage_pig, $manage_invoice, $read_employee, $manage_users, $permission_edit, $permission_delete,$permission_read,$manage_payroll, $permission_view];
        $permission_employee = [$read_payroll];
        $permission_specialEmployee = [$manage_feeds, $manage_sales,$add_sales,$manage_pig, $manage_invoice, $permission_create,$read_payroll, $permission_view,$add_customer ];
        $permission_owner =[$manage_sales,$manage_report, $read_employee, $permission_read, $permission_view, $manage_financial, $view_sales ];

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

