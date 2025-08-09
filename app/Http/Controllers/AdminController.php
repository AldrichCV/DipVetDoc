<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
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
        $users = User::where('role', '!=', 'admin')->paginate(10); // 10 users per page
        return view('users', compact('users'));
    }

    public function appointments()
    {
        $appointments = DB::table('user_appointments as ua')
            ->leftJoin('pets as p', 'ua.pet_code', '=', 'p.pet_code')
            ->leftJoin('users as u', 'ua.client_id', '=', 'u.id')  // Owner info
            ->leftJoin('services as s', 'ua.reason', '=', 's.id')  // Service name
            ->select(
                'ua.*',
                'ua.appointment_time',           // Include appointment time explicitly
                'p.name as pet_name',
                'p.breed',
                'p.species',
                'p.sex',
                'p.date_of_birth',
                'u.name as owner_name',
                's.name as reason_name',
                DB::raw('TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age')
            )
            ->orderBy('ua.appointment_date', 'desc')
            ->get();

        return view('vet_appointments', compact('appointments'));
    }

}

