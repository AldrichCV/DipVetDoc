<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Providers\PersonnelAssignment;

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
        $query = DB::table('user_appointments as ua')
            ->leftJoin('pets as p', 'ua.pet_code', '=', 'p.pet_code')
            ->leftJoin('services as s', 'ua.reason', '=', 's.id');

        if (auth()->user()->role === 'admin') {
            $query->leftJoin('users as owner', 'ua.client_id', '=', 'owner.id')
                ->select(
                    'ua.id as appointment_id',
                    'ua.*',
                    'p.name as pet_name',
                    'p.breed',
                    'p.species',
                    'p.sex',
                    'p.date_of_birth',
                    'owner.name as owner_name',
                    's.name as reason_name',
                    DB::raw('TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age'),
                    DB::raw('(SELECT JSON_ARRAYAGG(JSON_OBJECT(
                            "user_id", u.id,
                            "name", u.name,
                            "role", u.role
                        ))
                        FROM assigned_vet av
                        JOIN users u ON av.user_id = u.id
                        WHERE av.appointment_id = ua.id) as assigned_personnel')
                );
        } else {
            $query->where('ua.client_id', auth()->id())
                ->select(
                    'ua.id as appointment_id',
                    'ua.*',
                    'p.name as pet_name',
                    'p.breed',
                    'p.species',
                    'p.sex',
                    'p.date_of_birth',
                    's.name as reason_name',
                    DB::raw('TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age'),
                    DB::raw('(SELECT JSON_ARRAYAGG(JSON_OBJECT(
                            "user_id", u.id,
                            "name", u.name,
                            "role", u.role
                        ))
                        FROM assigned_vet av
                        JOIN users u ON av.user_id = u.id
                        WHERE av.appointment_id = ua.id) as assigned_personnel')
                );
        }

        $appointments = $query->orderBy('ua.appointment_date', 'desc')->get();

        // Decode JSON for assigned personnel
        $appointments->transform(function ($appointment) {
            $appointment->assigned_personnel = json_decode($appointment->assigned_personnel, true) ?? [];
            return $appointment;
        });

        return view('vet_appointments', compact('appointments'));
    }

    public function veterinarians()
    {
        $pendingVets = DB::table('users as u')
            ->leftJoin('vet_profile as vp', 'vp.user_id', '=', 'u.id')
            ->select(
                'u.*',
                'vp.specialization',
                'vp.is_active'
            )
            ->where('u.role', 'vet')
            ->where('u.status', 'pending')
            ->get();

        $approvedVets = DB::table('users as u')
            ->leftJoin('vet_profile as vp', 'vp.user_id', '=', 'u.id')
            ->select(
                'u.*',
                'vp.specialization',
                DB::raw("(CASE WHEN vp.is_active = 1 THEN 'Active' ELSE 'Inactive' END) as is_active")
            )
            ->where('u.role', 'vet')
            ->where('u.status', 'approved')
            ->get();


        return view('dipvet_veterinarians', compact('pendingVets', 'approvedVets'));
    }

    // AdminController.php
    public function assignVet(Request $request)
    {
        if (!$request->expectsJson()) {
            return response()->json(['message' => 'Only JSON requests allowed'], 406);
        }

        $request->validate([
            'vet_id' => 'required|integer|exists:vet_profile,user_id',
            'appointment_id' => 'required|integer|exists:user_appointments,id',
        ]);

        // Insert into assigned_vet table
        $inserted = DB::table('assigned_vet')->insert([
            'user_id' => $request->vet_id,
            'appointment_id' => $request->appointment_id,
        ]);

        return response()->json([
            'success' => (bool) $inserted,
            'message' => $inserted
                ? 'Vet assigned successfully.'
                : 'Failed to assign vet.',
        ], $inserted ? 200 : 400);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'vet_id' => 'required|integer|exists:vet_profile,user_id',
            'appointment_id' => 'required|integer|exists:user_appointments,id',
        ]);

        DB::table('assigned_vet')
            ->where('appointment_id', $request->appointment_id)
            ->where('user_id', $request->vet_id)
            ->delete();

        return response()->json(['success' => true]);
    }
}



