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

    static public function getCatgory()
    {
        return Category::select('categories.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'categories.created_by')
            ->where('categories.is_delete', '=', 'not')
            ->orderBy('categories.id', 'desc')
            ->get();
    }
}