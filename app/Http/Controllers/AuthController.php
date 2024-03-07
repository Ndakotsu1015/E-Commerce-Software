<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login_admin()
    {
        if (!empty(Auth::check()) && Auth::user()->user_type == 'Admin') {
            return redirect('admin/dashboard');
        }

        return view('admin.auth.login');

    }
    function auth_login_admin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'user_type' => 'Admin'], $remember)) {
            return redirect('admin/dashboard');

        } else {
            return redirect()->back()->with('error', 'Please enter correct email and password!');
        }

    }

    function logout_admin()
    {
        Auth::logout();
        return redirect('admin');

    }
}