<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=>captcha_img('math')]);
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'login' => ['required'],  // Menggunakan 'login' sebagai nama input
    //         'password' => ['required'],
    //         'captcha' => ['required','captcha'],
    //     ], [
    //         'captcha.required' => 'Captcha is required',
    //         'captcha.captcha' => 'Captcha is invalid',  // Menambahkan pesan khusus untuk captcha
    //     ]);
        
    //     try {
        
    //         // Ambil username atau email
    //         $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
    //         $credentials = [
    //             $loginField => $credentials['login'],
    //             'password' => $credentials['password'],
    //         ];
    
    //         if (!Auth::attempt($credentials)) {
    //             return back()->withErrors([
    //                 'login' => 'Username atau email yang anda masukkan tidak valid.',
    //             ])->onlyInput('login');
    //         }
    
    //         $user = Auth::user();
    //         if ($user && ($user->hasRole('admin') || $user->hasRole('superadmin'))) {
    //             $request->session()->regenerate();
    //             return redirect()->intended('dashboard');
    //         } else {
    //             return redirect()->route('home');
    //         }
    //     } catch (\Exception $e) {
    //         // Tangani kesalahan di sini, bisa log atau kembalikan pesan kesalahan
    //         return back()->withErrors([
    //             'login' => 'Terjadi kesalahan, silakan coba lagi.',
    //         ])->onlyInput('login');
    //     }
    // }
}
