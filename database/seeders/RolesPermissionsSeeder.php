<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $manage_financial = Permission::create (['name' =>'manage_finance']);
        $permission_read = Permission::create(['name' => 'read_invoice']);
        $permission_create = Permission::create(['name' => 'create_invoice']);
        $permission_edit = Permission::create(['name' => 'edit_invoice']);
        $permission_delete = Permission::create(['name' => 'delete_invoice']);
        $manage_payroll   = Permission::create (['name' =>'manage_payroll']);
        $read_payroll = Permission::create (['name' => 'read_payslip']);
        $manage_report = Permission::create (['name'=> 'manage_reports']);

        $permission_admin = [$manage_feeds, $manage_report,$manage_financial, $manage_pig, $manage_users, $permission_edit, $permission_delete,$permission_read,$manage_payroll];
        $permission_employee = [$read_payroll];
        $permission_specialEmployee = [$manage_feeds, $manage_pig, $permission_create,$read_payroll];
        $permission_owner =[$manage_report];

        $role_admin->syncPermissions($permission_admin);
        $role_employee->syncPermissions($permission_employee);
        $role_specialEmployee->syncPermissions($permission_specialEmployee);
        $role_owner->syncPermissions($permission_owner);

        User::find(1)->assignRole($role_admin);
        User::find(2)->assignRole($role_employee);
        User::find(3)->assignRole($role_specialEmployee);
        User::find(4)->assignRole($role_owner);

    }
}
