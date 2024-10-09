<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.modules.authentication.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }

    public function dashboard()
    {
        return view('admin.modules.dashboard'); 
    }
}
