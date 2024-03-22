<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';


    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getBrand()
    {
        return Brand::select('brands.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'brands.created_by')
            ->where('brands.is_delete', '=', 'not')
            ->orderBy('brands.id', 'desc')
            ->get();
    }
    static public function getBrandActive()
    {
        return Brand::select('brands.*')
            ->join('users', 'users.id', '=', 'brands.created_by')
            ->where('brands.is_delete', '=', 'not')
            ->where('brands.status', '=', 'Active')
            ->orderBy('brands.name', 'asc')
            ->get();
    }
}