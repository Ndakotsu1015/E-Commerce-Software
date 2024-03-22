<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'colors';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getColor()
    {
        return Color::select('colors.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'colors.created_by')
            ->where('colors.is_delete', '=', 'not')
            ->orderBy('colors.id', 'desc')
            ->get();
    }
    static public function getColorActive()
    {
        return Color::select('colors.*', )
            ->join('users', 'users.id', '=', 'colors.created_by')
            ->where('colors.is_delete', '=', 'not')
            ->where('colors.status', '=', 'Active')
            ->orderBy('colors.name', 'asc')
            ->get();
    }
}