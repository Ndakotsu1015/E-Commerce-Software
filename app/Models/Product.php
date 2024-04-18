<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getProductByCategorySubCategory($category_id = '', $subcategory_id = '')
    {
        $return = Product::select(
            'products.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'sub_categories.name as sub_category_name',
            'categories.slug as category_slug',
            'sub_categories.slug as sub_category_slug'
        )
            ->join('users', 'users.id', '=', 'products.created_by')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id');

        if (!empty($category_id)) {

            $return = $return->where('products.category_id', '=', $category_id);
        }
        if (!empty($subcategory_id)) {

            $return = $return->where('products.sub_category_id', '=', $subcategory_id);
        }

        if (!empty(Request::get('sub_category_id'))) {
            $subcategory_id = rtrim(Request::get('sub_category_id'), ',');
            $subcategory_id_array = explode(",", $subcategory_id);
            $return = $return->whereIn('products.sub_category_id', $subcategory_id_array);
        } else {
            if (!empty(Request::get('old_category_id'))) {

                $return = $return->where('products.category_id', '=', Request::get('old_category_id'));
            }
            if (!empty(Request::get('old_sub_category_id'))) {

                $return = $return->where('products.sub_category_id', '=', Request::get('old_sub_category_id'));
            }

        }

        if (!empty(Request::get('color_id'))) {

            $color_id = rtrim(Request::get('color_id'), ',');

            $color_id_array = explode(",", $color_id);

            $return = $return->join('product_colors', 'product_colors.product_id', '=', 'products.id');

            $return = $return->whereIn('product_colors.color_id', $color_id_array);
        }

        if (!empty(Request::get('brand_id'))) {
            $brand_id = rtrim(Request::get('brand_id'), ',');
            $brand_id_array = explode(",", $brand_id);
            $return = $return->whereIn('products.brand_id', $brand_id_array);
        }

        if (!empty(Request::get('start_price')) && !empty(Request::get('end_price'))) {

            $start_price = str_replace('₦', '', Request::get('start_price'));

            $end_price = str_replace('₦', '', Request::get('end_price'));

            $return = $return->where('products.new_price', '>=', $start_price);

            $return = $return->where('products.new_price', '<=', $end_price);

        }

        $return = $return->where('products.is_delete', '=', 'not')
            ->where('products.status', '=', 'Active')
            ->groupBy('products.id')
            ->orderBy('products.id', 'desc')
            ->paginate(30);

        return $return;

    }
    static public function getRelatedProduct($product_id, $sub_category_id)
    {
        $return = Product::select(
            'products.*',
            'users.name as created_by_name',
            'categories.name as category_name',
            'sub_categories.name as sub_category_name',
            'categories.slug as category_slug',
            'sub_categories.slug as sub_category_slug'
        )
            ->join('users', 'users.id', '=', 'products.created_by')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'products.sub_category_id')
            ->where('products.id', '!=', $product_id)
            ->where('products.sub_category_id', '=', $sub_category_id)
            ->where('products.is_delete', '=', 'not')
            ->where('products.status', '=', 'Active')
            ->groupBy('products.id')
            ->orderBy('products.id', 'desc')
            ->limit(10)
            ->get();

        return $return;

    }
    static public function getProduct()
    {
        return Product::select('products.*', 'users.name as created_by_name')
            ->join('users', 'users.id', '=', 'products.created_by')
            ->where('products.is_delete', '=', 'not')
            ->orderBy('products.id', 'desc')
            ->paginate(50);
    }

    static public function checkSlug($slug)
    {

        return self::where('slug', '=', $slug)->count();

    }
    public function getColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function getSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }
    public function getImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order_by', 'asc');
    }
    public function getImageSingle($product_id)
    {
        return ProductImage::where('product_id', '=', $product_id)
            ->orderBy('order_by', 'asc')
            ->first();

    }

    static public function getSingleSlug($slug)
    {
        return self::where('slug', '=', $slug)
            ->where('products.is_delete', '=', 'not')
            ->where('products.status', '=', 'Active')
            ->first();
    }
    public function getCategory()
    {

        return $this->belongsTo(Category::class, 'category_id');
    }
    public function getSubCategory()
    {

        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
