<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
       public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('users_list', compact('users'));
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
