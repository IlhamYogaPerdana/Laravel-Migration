<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showregister()
    {
        return view('auth.register');
    }

    public function registeruser(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ]);

        $userCount = User::count();

        $user = new User;
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $userCount === 0 ? 'admin' : 'user';

        $user->save();

        return redirect('/')->with('status', 'Register Berhasil');
    }

    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
       $credentials =  $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            return redirect('/')->with('status', 'Login Berhasil');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Logout Berhasil');
    }
}
