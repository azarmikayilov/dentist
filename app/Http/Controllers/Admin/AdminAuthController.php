<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/index');
        } else {
            return back()->withErrors(['message' => 'Kullanıcı adı veya şifre hatalı.'])->withInput();
        }
    }

    public function showRegistrationForm()
    {
        return view('admin.pages.auth.register');
    }

    public function register(Request $request)
    {
        $admin = new Admin();
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->save();

        Auth::guard('admin')->login($admin);

        return redirect()->intended('/admin/index');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
