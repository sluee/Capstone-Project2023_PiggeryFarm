<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users= [
            [
                'name' => 'Administrator',
                'email' => 'admin@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'admin'

            ],

            [
                'name' => 'Employee',
                'email' => 'employee@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'employee'

            ],

            [
                'name' => 'Special Employee',
                'email' => 'special@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'specialEmployee'

            ],
            [

                'name' => 'Owner',
                'email' => 'owner@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'owner'

            ]

        ];

        foreach($users as $user){
             User::create([
                'name'  =>$user['name'],
                'email' =>$user['email'],
                'password' =>Hash::make($user['password']),
            ]);

            // $created_user->assignRole($user['role']);
        }
    }
}
