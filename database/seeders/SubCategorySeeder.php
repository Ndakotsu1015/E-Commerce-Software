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

            [
                'name' => 'Fashion',
                'category_id' => 1,
                'created_by' => 2,
                'slug' => 'fashion',
                'status' => 'Active',
                'is_delete' => 'not',
                'meta_title' => 'Fashion',
                'meta_description' => 'Fashion Styles',
                'meta_keywords' => 'fasions, styles',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Electronics',
                'category_id' => 2,
                'created_by' => 2,
                'slug' => 'electronics',
                'status' => 'Active',
                'is_delete' => 'not',
                'meta_title' => 'Electronic equipments',
                'meta_description' => 'Electronic devices for households',
                'meta_keywords' => 'electronics, divices',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Computers and Laptops',
                'category_id' => 3,
                'created_by' => 2,
                'slug' => 'accessories',
                'status' => 'Active',
                'is_delete' => 'not',
                'meta_title' => 'Accessories',
                'meta_description' => 'Computers and Laptops',
                'meta_keywords' => 'computers, laptops',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'eBooks',
                'category_id' => 4,
                'created_by' => 2,
                'slug' => 'books',
                'status' => 'Active',
                'is_delete' => 'not',
                'meta_title' => 'Electronic Books',
                'meta_description' => 'Electronic Online Books',
                'meta_keywords' => 'books, dictionaeries',
                'created_at' => now(),
                'updated_at' => now()
            ],



        ]);
    }
}
