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

      $users= [
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' =>bcrypt('password123'),
        ]),

        \App\Models\User::factory()->create([
            'name' => ' Employee',
            'email' => 'employee@test.com',
            'password' =>bcrypt('password123'),
        ]),
        \App\Models\User::factory()->create([
            'name' => 'Special Employee',
            'email' => 'special@test.com',
            'password' =>bcrypt('password123'),
        ]),

        \App\Models\User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@test.com',
            'password' =>bcrypt('password123'),

        ]),
        $this->call([
            RolesPermissionsSeeder::class,
            // UserSeeder::class
        ]),
    ];
    }
}


