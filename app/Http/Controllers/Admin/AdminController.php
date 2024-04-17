<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();

        $data['header_title'] = "Admin";

        return view('admin.admin.list', $data);
    }
    public function add()
    {


        $data['header_title'] = "Add New Admin";

        return view('admin.admin.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $email = $request['email'];
        $user = new User;
        $user->name = $request->name;
        $user->email = $email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->user_type = "Admin";
        $user->save();

        return redirect('admin/admin/list')->with('success', 'Admin Successfuly Created!');

    }

    public function edit($id)
    {


        $data['getRecord'] = User::getSingle($id);

        $data['header_title'] = "Edit Admin";

        return view('admin.admin.edit', $data);
    }

    public function update($id, Request $request)
    {
        $user = User::getSingle($id);

        request()->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $email = $request['email'];
        $user = User::getSingle($id);
        $user->name = $request->name;
        $user->email = $email;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->user_type = "Admin";
        ;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'Admin Successfuly Updated!');

    }
    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 'deleted';
        $user->save();

        return redirect()->back()->with('success', 'Admin Successfully Deleted!');

    }
}
