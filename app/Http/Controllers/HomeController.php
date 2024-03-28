<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        // $getCategory = Category::getSingleSlug($slug);

        // $getSubCategory = SubCategory::getSingleSubSlug($subslug);

        $data['meta_title'] = 'E-Commerce';

        $data['meta_description'] = '';

        $data['meta_keywords'] = '';
        return view('home', $data);
    }

}