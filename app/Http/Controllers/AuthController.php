<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login page
     * 
     */
    public function login_page(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Attempt to login user
     * 
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->route('products');
        }

        return back()->withErrors(['Username atau password Anda salah.']);
    }
    
    /**
     * Log current user out
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->route('login');
    }
}
