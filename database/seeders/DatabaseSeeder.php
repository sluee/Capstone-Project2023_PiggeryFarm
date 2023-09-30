<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RolesPermissionsSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        \App\Models\User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Administrator',
            'gender' => 'Female',
            'phone'=> '09121244888',
            'email' => 'admin@test.com',
            'password' =>bcrypt('password123'),
        ]);

        \App\Models\User::factory()->create([
            'firstName' => 'test',
            'lastName' => 'Employee',
            'gender' => 'Female',
            'phone'=> '09121244888',
            'email' => 'employee@test.com',
            'password' =>bcrypt('password123'),
        ]);
        \App\Models\User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Special Employee',
            'gender' => 'Male',
            'phone'=> '09121244888',
            'email' => 'special@test.com',
            'password' =>bcrypt('password123'),
        ]);

        \App\Models\User::factory()->create([
                'firstName' => 'Test',
                'lastName' => 'Owner',
                'gender' => 'Male',
                'phone'=> '09121244888',
                'email' => 'owner@test.com',
                'password' =>bcrypt('password123'),

        ]);
        $this->call([
            RolesPermissionsSeeder::class,
            // UserSeeder::class
        ]);

    }
}


