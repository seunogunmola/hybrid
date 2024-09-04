<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        DB::table('users')->insert(
            [
                //ADMIN
                [
                    'uniqueid'=>Str::random(7),
                    'firstname'=>'Admin',
                    'lastname'=>'User',
                    'username'=>'admin',
                    'email'=>'admin@hybrid.com',
                    'password'=>Hash::make('admin'),
                    'role'=>'admin',
                    'status'=>'active',
                ],
                //USER
                [
                    'uniqueid'=>Str::random(7),
                    'firstname'=>'Basic',
                    'lastname'=>'User',
                    'username'=>'user',
                    'email'=>'user@hybrid.com',
                    'password'=>Hash::make('user'),
                    'role'=>'user',
                    'status'=>'active',
                ]
            ]
        );
    }
}
