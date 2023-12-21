<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Empty the roles table first
        DB::table('roles')->delete();

        // Define the roles to insert
        $roles = [
            ['name' => 'admin', 'description' => 'Administrator with full access'],
            ['name' => 'user', 'description' => 'Regular user with limited access'],
        ];

        // Insert roles into the table
        DB::table('roles')->insert($roles);
    }
}
