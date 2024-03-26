<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    static public function getSingle($id)
    {
        return Category::find($id);
    }

    static public function getCategory()
    {
        return Category::select('categories.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 'not')
            ->orderBy('categories.id', 'desc')
            ->get();
    }
    static public function getCategoryActive()
    {
        return Category::select('categories.*')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 'not')
            ->where('categories.status', '=', 'Active')
            ->orderBy('categories.name', 'asc')
            ->get();
    }
    static public function getCategoryMenu()
    {
        return Category::select('categories.*')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 'not')
            ->where('categories.status', '=', 'Active')
            ->get();
    }

    public function getSubCategory()
    {
        return $this->hasMany(SubCategory::class, 'category_id')
            ->where('sub_categories.status', '=', 'Active')
            ->where('sub_categories.is_delete', '=', 'not');
    }
}