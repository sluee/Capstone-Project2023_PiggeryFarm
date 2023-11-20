<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RolesPermissionsSeeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'firstName' => 'Test',
        //     'lastName' => 'Administrator',
        //     'gender' => 'Female',
        //     'phone'=> '09121244888',
        //     'address'=> 'Sagbayan, Bohol',
        //     'email' => 'admin@test.com',
        //     'password' =>bcrypt('password123'),
        // ]);

        // \App\Models\User::factory()->create([
        //     'firstName' => 'test',
        //     'lastName' => 'Employee',
        //     'gender' => 'Female',
        //     'phone'=> '09121244888',
        //     'address'=> 'Sagbayan, Bohol',
        //     'email' => 'employee@test.com',
        //     'password' =>bcrypt('password123'),
        // ]);
        // \App\Models\User::factory()->create([
        //     'firstName' => 'Test',
        //     'lastName' => 'Special Employee',
        //     'gender' => 'Male',
        //     'phone'=> '09121244888',
        //     'address'=> 'Sagbayan, Bohol',
        //     'email' => 'special@test.com',
        //     'password' =>bcrypt('password123'),
        // ]);

        // \App\Models\User::factory()->create([
        //         'firstName' => 'Test',
        //         'lastName' => 'Owner',
        //         'gender' => 'Male',
        //         'phone'=> '09121244888',
        //         'address'=> 'Sagbayan, Bohol',
        //         'email' => 'owner@test.com',
        //         'password' =>bcrypt('password123'),

        // ]);
        // $this->call([
        //     RolesPermissionsSeeder::class,
        //     // UserSeeder::class
        // ]);
        $type = ['owner', 'employee', 'admin'];
        $managerPosition = Position::factory()->create([
            'position' => 'Manager',
            'rate' => 40.00,
        ]);

        $specialPosition = Position::factory()->create([
            'position' => 'Developer',
            'rate' => 30.00,
        ]);
        User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Admin',
            'gender' => 'Male',
            'phone' => '09121244888',
            'address' => 'Sagbayan, Bohol',
            'email' => 'admin@test.com',
            'type' => $type[2], // Use index 2 for 'admin'
            'password' => bcrypt('password123'),
        ]);

        DB::transaction(function () use ($managerPosition, $specialPosition, $type) {
            // Create a user with the 'Developer' type

            // Create a user with the 'Manager' type
            $manager = User::factory()->create([
                'firstName' => 'Test',
                'lastName' => 'Manager',
                'gender' => 'Male',
                'phone' => '09121244888',
                'address' => 'Sagbayan, Bohol',
                'type' => $type[1], // Use index 0 for 'owner'
                'email' => 'employee@test.com',
                'password' => bcrypt('password123'),
            ]);

            // Create an employee record for the manager with a specific pos_id
            $managerEmployee = Employee::factory()->create([
                'pos_id' => $managerPosition->id,
                'user_id' => $manager->id,
            ]);

            // Associate the employee with the user
            $manager->employee()->save($managerEmployee);

            $special = User::factory()->create([
                'firstName' => 'Test',
                'lastName' => 'special',
                'gender' => 'Male',
                'phone' => '09121244888',
                'address' => 'Sagbayan, Bohol',
                'type' => $type[1],
                'email' => 'specialEmployee@test.com',
                'password' => bcrypt('password123'),
            ]);

            // Create an employee record for the special with a specific pos_id
            $specialEmployee = Employee::factory()->create([
                'pos_id' => $specialPosition->id,
                'user_id' => $special->id,
            ]);

            // Associate the employee with the user
            $special->employee()->save($specialEmployee);

        });

        // Create an owner user
        User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Owner',
            'gender' => 'Male',
            'phone' => '09121244888',
            'address' => 'Sagbayan, Bohol',
            'email' => 'owner@test.com',
            'type' => $type[0], // Use index 1 for 'employee'
            'password' => bcrypt('password123'),
        ]);

        // Create an admin user


        $this->call([
            RolesPermissionsSeeder::class,
            // UserSeeder::class
        ]);


    }
}


