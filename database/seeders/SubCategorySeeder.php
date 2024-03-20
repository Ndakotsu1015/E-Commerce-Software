<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([

            // [
            //     'name' => 'Life Style',
            //     'category_id' => 1,
            //     'slug' => 'One-home',
            //     'created_by' => 'Admin',
            //     'meta_title' => 'My first sub category',
            //     'meta_keywords' => 'My first sub category Keywords',
            //     'meta_description' => 'My first sub category Description',
            //     'status' => 'Active',
            //     'is_delete' => 'not',
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // [
            //     'name' => 'Hobbies',
            //     'category_id' => 2,
            //     'slug' => 'One-Funiture',
            //     'created_by' => 'Admin',
            //     'meta_title' => 'My second sub category',
            //     'meta_keywords' => 'My second sub category Keywords',
            //     'meta_description' => 'My second sub category Description',
            //     'status' => 'Active',
            //     'is_delete' => 'not',
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],


        ]);
    }
}