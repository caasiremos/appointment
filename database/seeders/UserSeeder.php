<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => "nakigulistella2@gmail.com",
            'name' => 'Stella Nakiguli',
            'telephone' => '256786966244',
            'password' =>  Hash::make('password'),
            'position' => 'Associate'
        ]);

        User::first()->attachRole(Role::first());
    }
}
