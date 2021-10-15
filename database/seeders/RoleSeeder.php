<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => "Admin",
            'display_name' => "Admin",
            'description' => "Allow User to control the system ACL",
        ]);
    }
}
