<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = 'sub_categories';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getSingleSubSlug($subslug)
    {
        return SubCategory::where('slug', '=', $subslug)
            ->where('sub_categories.status', '=', 'Active')
            ->where('sub_categories.is_delete', '=', 'not')
            ->first();
    }
    static public function getSubCategory()
    {
        return SubCategory::select('sub_categories.*', 'users.name as created_by_name', 'categories.name as category_name')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 'not')
            ->orderBy('sub_categories.id', 'desc')
            ->paginate(50);
    }
    static public function getSubCategoryRecord($category_id)
    {
        return SubCategory::select('sub_categories.*')
            ->join('users', 'users.id', '=', 'sub_categories.created_by')
            ->where('sub_categories.is_delete', '=', 'not')
            ->where('sub_categories.status', '=', 'Active')
            ->where('sub_categories.category_id', '=', $category_id)
            ->orderBy('sub_categories.name', 'asc')
            ->get();
    }
    public function TotalProduct()
    {
        return $this->hasMany(Product::class, 'sub_category_id')
            ->where('products.is_delete', '=', 'not')
            ->where('products.status', '=', 'Active')
            ->count();
    }
}