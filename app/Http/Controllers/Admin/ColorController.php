<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Auth;

class ColorController extends Controller
{
    public function list()
    {
        $data['getRecord'] = Color::getColor();
        $data['header_title'] = 'Color';
        return view('admin.color.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Color';
        return view('admin.color.add', $data);

    }
    public function insert(Request $request)
    {

        $brand = new Color;

        $brand->name = trim($request->name);
        $brand->code = trim($request->code);

        $brand->status = $request->status;

        $brand->created_by = Auth::user()->id;

        $brand->save();

        return redirect('admin/color/list')->with('success', 'Brand Successfully Created!');

    }
    public function edit($id)
    {
        $data['getRecord'] = Color::getSingle($id);
        $data['header_title'] = 'Edit Color';

        return view('admin.color.edit', $data);

    }

    public function update($id, Request $request)
    {

        $color = Color::getSingle($id);
        $color->name = $request->name;
        $color->code = $request->code;
        $color->status = $request->status;
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin/color/list')->with('success', 'Color Successfully Updated!');

    }
    public function delete($id)
    {
        $color = Color::getSingle($id);
        $color->is_delete = 'deleted';
        $color->save();

        return redirect()->back()->with('success', 'Color Successfully Deleted!');

    }
}
