<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' =>'admin',
            'email'=> 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' =>'admin'
        ]);
    }
}
