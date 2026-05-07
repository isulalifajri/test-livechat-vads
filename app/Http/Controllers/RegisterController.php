<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=>captcha_img('mini')]);
    }
}
