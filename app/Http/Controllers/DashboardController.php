<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Page';
        return view('dashboard.dashboard', compact(
            'title',
        ));

    }
}
