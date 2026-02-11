<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
        // validasi input dari user
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        // proses login
        if(Auth::attempt($validator)){
            $request->session()->regenerate();
            return redirect()->intended('/admin')->with('success','Login Berhasil');
        }

        //ketika gagal login
        return back()->withErrors([
            'email' => 'Email dan password tidak sesuai'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // public function showRegisterForm()
    // {
    //     return view('auth.register');
    // }

    public function register(Request $request){
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'=>$validator['name'],
            'email'=>$validator['email'],
            'password'=>Hash::make($validator['password']),
        ]);

        return redirect('/login')->with('success','Registrasi Berhasil. Silahkan Login');
    }
}
