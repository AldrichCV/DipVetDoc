<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function Dashboard()
    {
        if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('AdminPage');
}

    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('users', compact('users'));
    }

      public function appointments()
    {
       $appointments = DB::table('user_appointments as ua')
        ->leftJoin('pets as p', 'ua.pet_code', '=', 'p.pet_code')
        ->select('ua.*', 'p.name as pet_name')
        ->orderBy('ua.appointment_date', 'desc')
        ->get();

    return view('vet_appointments', compact('appointments'));
    }
}