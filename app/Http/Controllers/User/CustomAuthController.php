<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;  // <-- Import the base Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CustomAuthController extends Controller
{

    public function showRegisterForm()
    {
        return view('user.modules.authentication.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'user', 
        ]);
    
        Auth::login($user);
    
        return redirect()->route('user.home');
    }
    


    public function showLoginForm()
    {
        return view('user.modules.authentication.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.home');
    }
}
