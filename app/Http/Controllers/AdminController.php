<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use App\Providers\PersonnelAssignment;
use Inertia\Inertia;

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
        return Inertia::render('Users', [
            'title' => 'Users', // optional props
        ]);
    }

    public function appointments()
    {
         // Render the Appointments.vue page via Inertia
        return Inertia::render('Appointments', [
            'title' => 'Appointments', // optional props
        ]);
    }

    // // In VetController.php
    // public function getAvailableVets()
    // {
    //     $vets = DB::table('users as u')
    //         ->join('vet_profile as vp', 'vp.user_id', '=', 'u.id')
    //         ->select(
    //             'u.id',
    //             'u.name',
    //             'vp.specialization'
    //         )
    //         ->where('u.role', 'vet')
    //         ->get();

    //     return response()->json($vets);
    // }
    
    // public function veterinarians()
    // {
    //     $pendingVets = DB::table('users as u')
    //         ->leftJoin('vet_profile as vp', 'vp.user_id', '=', 'u.id')
    //         ->select(
    //             'u.*',
    //             'vp.specialization',
    //             'vp.is_active'
    //         )
    //         ->where('u.role', 'vet')
    //         ->where('u.status', 'pending')
    //         ->get();

    //     $approvedVets = DB::table('users as u')
    //         ->leftJoin('vet_profile as vp', 'vp.user_id', '=', 'u.id')
    //         ->select(
    //             'u.*',
    //             'vp.specialization',
    //             DB::raw("(CASE WHEN vp.is_active = 1 THEN 'Active' ELSE 'Inactive' END) as is_active")
    //         )
    //         ->where('u.role', 'vet')
    //         ->where('u.status', 'approved')
    //         ->get();

    //     return view('dipvet_veterinarians', compact('pendingVets', 'approvedVets'));
    // }

    // // AdminController.php
    // public function assignVet(Request $request)
    // {
    //     if (!$request->expectsJson()) {
    //         return response()->json(['message' => 'Only JSON requests allowed'], 406);
    //     }

    //     $request->validate([
    //         'vet_id' => 'required|integer|exists:vet_profile,user_id',
    //         'appointment_id' => 'required|integer|exists:user_appointments,id',
    //     ]);

    //     // Insert into assigned_vet table
    //     $inserted = DB::table('assigned_vet')->insert([
    //         'user_id' => $request->vet_id,
    //         'appointment_id' => $request->appointment_id,
    //     ]);

    //     return response()->json([
    //         'success' => (bool) $inserted,
    //         'message' => $inserted
    //             ? 'Vet assigned successfully.'
    //             : 'Failed to assign vet.',
    //     ], $inserted ? 200 : 400);
    // }

    // public function remove(Request $request)
    // {
    //     $request->validate([
    //         'vet_id' => 'required|integer|exists:vet_profile,user_id',
    //         'appointment_id' => 'required|integer|exists:user_appointments,id',
    //     ]);

    //     DB::table('assigned_vet')
    //         ->where('appointment_id', $request->appointment_id)
    //         ->where('user_id', $request->vet_id)
    //         ->delete();

    //     return response()->json(['success' => true]);
    // }

    // public function search(Request $request)
    // {
    //     $query = $request->input('q');

    //     $pets = \App\Models\Pet::where('name', 'like', "%{$query}%")
    //                 ->orWhere('breed', 'like', "%{$query}%")
    //                 ->get();

    //     $owners = \App\Models\User::where('role', 'user')
    //                 ->where('name', 'like', "%{$query}%")
    //                 ->get();

    //     $vets = \App\Models\User::where('role', 'vet')
    //                 ->where('name', 'like', "%{$query}%")
    //                 ->get();

    //     // Merge them into one collection
    //     $results = $pets->concat($owners)->concat($vets);

    //     return view('search_result', compact('query', 'results'));
    // }
}



