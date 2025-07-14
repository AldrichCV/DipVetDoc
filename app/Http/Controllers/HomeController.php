<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function Home()
    {
        if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('HomePage');
}

    public function Clinic()
    {
        return view('ClinicPage');
    }
    
    public function Gallery()
    {
        return view('GalleryPage');
    }

    public function Login()
    {
        return view('LoginPage');
    }
}
