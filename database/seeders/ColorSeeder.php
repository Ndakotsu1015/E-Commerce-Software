<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colors')->insert([

            [
                'name' => 'Black',
                'code' => '#000000',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'White',
                'code' => '#f8f7f7',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Blue',
                'code' => '#0d1cf8',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Green',
                'code' => '#0cdf36',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yellow',
                'code' => '#f0fd3f',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Red',
                'code' => '#f91010',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Purple',
                'code' => '#6c0e61',
                'created_by' => 2,
                'status' => 'Active',
                'is_delete' => 'not',
                'created_at' => now(),
                'updated_at' => now()
            ],


        ]);

    }


}
