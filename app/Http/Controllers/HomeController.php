<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the main home page
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the dashboard (protected)
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}
