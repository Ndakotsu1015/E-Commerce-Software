<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function getImages()
    {
        if (!empty ($this->image_name) && file_exists('uploads/products/' . $this->image_name)) {
            return url('uploads/products/' . $this->image_name);

        } else {
            return "";
        }

    }
}