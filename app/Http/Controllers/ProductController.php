<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function getSearchProduct(Request $request)
    {
        $data['meta_title'] = 'Search';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        // Assuming getProductByCategorySubCategory() returns a query builder
        $query = Product::getProductByCategorySubCategory();

        // Paginate the results manually
        $perPage = 10; // Assuming 10 items per page, change according to your requirement
        $page = $request->query('page', 1); // Get the current page from the request query parameters
        $getProduct = $query->paginate($perPage, ['*'], 'page', $page);

        // Extracting page number
        $page = $getProduct->currentPage();

        $data['page'] = $page;
        $data['getProduct'] = $getProduct; // Passing paginated results to the view
        $data['getColor'] = Color::getColorActive();
        $data['getBrand'] = Brand::getBrandActive();

        return view('product.list', $data);
    }

    // public function getSearchProduct(Request $request)
    // {


    //     $data['meta_title'] = 'Search';

    //     $data['meta_description'] = '';

    //     $data['meta_keywords'] = '';

    //     $getProduct = Product::getProductByCategorySubCategory();

    //     $page = 0;
    //     if (!empty($getProduct->nextPageUrl())) {

    //         $parse_url = parse_url($getProduct->nextPageUrl());


    //         if (!empty($parse_url['query'])) {

    //             parse_str($parse_url['query'], $get_array);

    //             $page = !empty($get_array['page']) ? $get_array['page'] : 0;
    //         }
    //     }

    //     $data['page'] = $page;

    //     $data['getProduct'] = $getProduct;
    //     $data['getColor'] = Color::getColorActive();
    //     $data['getBrand'] = Brand::getBrandActive();
    //     return view('product.list', $data);


    // }
    // public function getSearchProduct(Request $request)
    // {
    //     $data['meta_title'] = 'Search';
    //     $data['meta_description'] = '';
    //     $data['meta_keywords'] = '';

    //     // Assuming getProductByCategorySubCategory() returns a paginated result
    //     $getProduct = Product::getProductByCategorySubCategory();

    //     $page = 0;
    //     // Checking if there's a next page URL
    //     if (!is_null($getProduct->nextPageUrl())) {
    //         $parse_url = parse_url($getProduct->nextPageUrl());

    //         if (!empty($parse_url['query'])) {
    //             parse_str($parse_url['query'], $get_array);
    //             $page = !empty($get_array['page']) ? $get_array['page'] : 0;
    //         }
    //     }

    //     $data['page'] = $page;
    //     $data['getProduct'] = $getProduct->items(); // Fetching items from the paginator
    //     $data['getColor'] = Color::getColorActive();
    //     $data['getBrand'] = Brand::getBrandActive();

    //     return view('product.list', $data);
    // }

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

            $data['getRelatedProduct'] = Product::getRelatedProduct($getProductSingle->product_id, $getProductSingle->sub_category_id);

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