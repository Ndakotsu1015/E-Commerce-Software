<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategory($slug, $subslug = '')
    {

        $getProductSingle = Product::getSingleSlug($slug);

        $getCategory = Category::getSingleSlug($slug);

        $getSubCategory = SubCategory::getSingleSubSlug($subslug);

        $data['getColor'] = Color::getColorActive();
        $data['getBrand'] = Brand::getBrandActive();

        if (!empty($getProductSingle)) {

            $data['meta_title'] = $getProductSingle->title;

            $data['meta_description'] = $getProductSingle->short_description;



            $data['getProduct'] = $getProductSingle;

            return view('product.detail', $data);

        } else if (!empty($getSubCategory) && !empty($getCategory)) {

            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getSubCategory'] = $getSubCategory;

            $data['getCategory'] = $getCategory;

            $getProduct = Product::getProductByCategorySubCategory($getCategory->id, $getSubCategory->id);

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {

                $parse_url = parse_url($getProduct->nextPageUrl());


                if (!empty($parse_url['query'])) {

                    parse_str($parse_url['query'], $get_array);

                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;
            $data['getProduct'] = $getProduct;

            $data['getSubCategoryFilter'] = SubCategory::getSubCategoryRecord($getCategory->id);

            return view('product.list', $data);

        } else if (!empty($getCategory)) {

            $data['getSubCategoryFilter'] = SubCategory::getSubCategoryRecord($getCategory->id);

            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;

            $data['meta_description'] = $getCategory->meta_description;

            $data['meta_keywords'] = $getCategory->meta_keywords;

            $getProduct = Product::getProductByCategorySubCategory($getCategory->id);

            $page = 0;
            if (!empty($getProduct->nextPageUrl())) {

                $parse_url = parse_url($getProduct->nextPageUrl());


                if (!empty($parse_url['query'])) {

                    parse_str($parse_url['query'], $get_array);

                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }

            $data['page'] = $page;

            $data['getProduct'] = $getProduct;
            return view('product.list', $data);
        } else {
            abort(404);
        }
    }

    public function getFilterProductAjax(Request $request)
    {


        $getProduct = Product::getProductByCategorySubCategory();
        $page = 0;
        if (!empty($getProduct->nextPageUrl())) {

            $parse_url = parse_url($getProduct->nextPageUrl());


            if (!empty($parse_url['query'])) {

                parse_str($parse_url['query'], $get_array);

                $page = !empty($get_array['page']) ? $get_array['page'] : 0;
            }
        }

        // $data['page'] = $page;

        return response()->json([
            "status" => true,

            "page" => $page,

            "success" => view('product._list', [

                "getProduct" => $getProduct,
            ])->render()

        ], 200);


    }
}