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
                'firstName' => 'Administrator',
                'lastName' => 'test',
                'email' => 'admin@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'admin'

            ],

            [
                'firstName' => 'test',
                'lastName' => 'Employee',
                'email' => 'employee@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'employee'

            ],

            [
                'firstName' => 'Test',
                'lastName' => 'Special Employee',
                'email' => 'special@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'specialEmployee'

            ],
            [

                'firstName' => 'Test',
                'lastName' => 'Owner',
                'email' => 'owner@test.com',
                'password' =>bcrypt('password123'),
                // 'role'  => 'owner'

            ]

        ];

        foreach($users as $user){
             User::create([
                'firstName'  =>$user['firstName'],
                'lastName'  =>$user['lastName'],
                'email' =>$user['email'],
                'password' =>Hash::make($user['password']),
            ]);

            // $created_user->assignRole($user['role']);
        }
    }
}
