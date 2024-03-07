<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([

            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('123456'),
                'user_type' => 'Super-Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'user_type' => 'Admin',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Baba Usman',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('123456'),
                'user_type' => 'Customer',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }

}
