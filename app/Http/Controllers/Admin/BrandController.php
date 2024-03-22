<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Auth;

class BrandController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Brand::getBrand();
        $data['header_title'] = 'Brand';
        return view('admin.brand.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Brand';
        return view('admin.brand.add', $data);

    }
    public function insert(Request $request)
    {
        request()->validate([
            'slug' => 'required|unique:brands'
        ]);
        $brand = new Brand;

        $brand->name = trim($request->name);

        $brand->slug = trim($request->slug);

        $brand->status = $request->status;

        $brand->meta_title = trim($request->meta_title);

        $brand->meta_keywords = trim($request->meta_keywords);

        $brand->meta_description = trim($request->meta_description);

        $brand->created_by = Auth::user()->id;

        $brand->save();

        return redirect('admin/brand/list')->with('success', 'Brand Successfully Created!');

    }
    public function edit($id)
    {
        $data['getRecord'] = Brand::getSingle($id);
        $data['header_title'] = 'Edit Brand';

        return view('admin.brand.edit', $data);

    }

    public function update($id, Request $request)
    {

        $brand = Brand::getSingle($id);

        request()->validate([
            'slug' => 'required|unique:brands,slug,' . $brand->id,
        ]);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->meta_title = $request->meta_title;
        $brand->meta_description = $request->meta_description;
        $brand->meta_keywords = $request->meta_keywords;
        $brand->status = $request->status;
        $brand->created_by = Auth::user()->id;
        $brand->save();

        return redirect('admin/brand/list')->with('success', 'Brand Successfully Updated!');

    }
    public function delete($id)
    {
        $brand = Brand::getSingle($id);
        $brand->is_delete = 'deleted';
        $brand->save();

        return redirect()->back()->with('success', 'Brand Successfully Deleted!');

    }
}