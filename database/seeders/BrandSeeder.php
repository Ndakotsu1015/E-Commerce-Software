<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([

            [
                'name' => 'fashion-brand',
                'created_by' => 2,
                'slug' => 'fashion_brand',
                'status' => 'Active',
                'is_delete' => 'not',
                'meta_title' => 'My Fashion Brand',
                'meta_description' => 'Fashion Brand Styles',
                'meta_keywords' => 'fasions, brands',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Electronic brands',
                'created_by' => 2,
                'slug' => 'electronic_brands',
                'status' => 'Active',
                'is_delete' => 'not',
                'meta_title' => 'My Electronic Brands',
                'meta_description' => 'Electronic  Brands',
                'meta_keywords' => 'electronics, wires',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Computers and Laptops',
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
