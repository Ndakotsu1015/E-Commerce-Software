<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;

class SubCategoryController extends Controller
{
    public function list()
    {

        $data['getRecord'] = SubCategory::getSubCategory();

        $data['header_title'] = 'Sub Category';

        return view('admin.subcategory.list', $data);


    }
    public function add()
    {

        $data['getCategory'] = Category::getCategory();
        $data['header_title'] = 'Add New Sub Category';

        return view('admin.subcategory.add', $data);

    }

    public function insert(Request $request)
    {

        request()->validate([
            'slug' => 'required|unique:sub_categories'

        ]);

        $subcategory = new SubCategory;
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Subcategory Successully Created!');



    }
    public function edit($id)
    {
        $data['getCategory'] = Category::getCategory();
        $data['getRecord'] = SubCategory::getSingle($id);
        $data['header_title'] = 'Edit Sub Category';

        return view('admin.subcategory.edit', $data);

    }

    public function update($id, Request $request)
    {

        request()->validate([
            'slug' => 'required|unique:sub_categories,slug,' . $id

        ]);

        $subcategory = SubCategory::getSingle($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', 'Subcategory Successully Updated!');

    }

    public function delete($id)
    {
        $subcategory = SubCategory::getSingle($id);
        $subcategory->is_delete = 'deleted';
        $subcategory->save();

        return redirect()->back()->with('success', 'Sub Category Successfully Deleted!');

    }

    public function get_sub_category(Request $request)
    {
        $category_id = $request->id;
        $get_sub_category = SubCategory::getSubCategoryRecord($category_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($get_sub_category as $value) {
            $html .= '<option value="' . $value->id . '">' . $value->name . '</option>';
        }

        $json['html'] = $html;
        echo json_encode($json);
    }




}
