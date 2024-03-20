<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function list()
    {

        $data['getRecord'] = Category::getCatgory();

        $data['header_title'] = 'Category';

        return view('admin.category.list', $data);


    }
    public function add()
    {



        $data['header_title'] = 'Add new Category';

        return view('admin.category.add', $data);


    }

    public function insert(Request $request)
    {


        request()->validate([
            'slug' => 'required|unique:categories'
        ]);
        $category = new Category;

        $category->name = trim($request->name);

        $category->slug = trim($request->slug);

        $category->status = $request->status;

        $category->meta_title = trim($request->meta_title);

        $category->meta_keywords = trim($request->meta_keywords);

        $category->meta_description = trim($request->meta_description);

        $category->created_by = Auth::user()->id;

        $category->save();

        return redirect('admin/category/list')->with('success', 'Category Successfully Created!');
    }
    public function edit($id)
    {
        $data['getRecord'] = Category::getSingle($id);
        $data['header_title'] = 'Edit Category';

        return view('admin.category.edit', $data);

    }

    public function update($id, Request $request)
    {

        $category = Category::getSingle($id);

        request()->validate([
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->status = $request->status;
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category/list')->with('success', 'Category Successfully Updated!');

    }
    public function delete($id)
    {
        $category = Category::getSingle($id);
        $category->is_delete = 'deleted';
        $category->save();

        return redirect()->back()->with('success', 'Category Successfully Deleted!');

    }
}