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
    $users = User::where('role', '!=', 'admin')
        ->leftJoin('vet_profile', 'users.id', '=', 'vet_profile.user_id')
        ->select('users.*', 'vet_profile.specialization', 'vet_profile.clinic_name')
        ->orderBy('users.created_at', 'desc')
        ->paginate(9);

    // Convert paginated data for Vue
    $usersData = [
        'data' => $users->items(),
        'current_page' => $users->currentPage(),
        'last_page' => $users->lastPage(),
        'per_page' => $users->perPage(),
        'total' => $users->total(),
    ];

    return view('users', compact('usersData'));
}

public function appointments()
{
    $baseSelect = [
        'ua.id as appointment_id',
        'ua.*',
        'p.id as pet_id',
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
    ];

    $query = DB::table('user_appointments as ua')
        ->leftJoin('pets as p', 'ua.pet_code', '=', 'p.pet_code')
        ->leftJoin('services as s', 'ua.reason', '=', 's.id')
        ->orderBy('ua.appointment_date', 'desc');

    // Role-specific filters
    if (auth()->user()->role === 'admin') {
        $query->leftJoin('users as owner', 'ua.client_id', '=', 'owner.id')
              ->addSelect('owner.id as owner_id', 'owner.name as owner_name')
              ->addSelect($baseSelect);

    } elseif (auth()->user()->role === 'vet') {
        $query->leftJoin('users as owner', 'ua.client_id', '=', 'owner.id')
              ->whereIn('ua.id', function ($sub) {
                  $sub->select('appointment_id')
                      ->from('assigned_vet')
                      ->where('user_id', auth()->id());
              })
              ->addSelect('owner.id as owner_id', 'owner.name as owner_name')
              ->addSelect($baseSelect);

    } else {
        // For normal users (clients)
        $query->where('ua.client_id', auth()->id())
              ->addSelect($baseSelect);
    }

    $appointments = $query->get();

    // Decode JSON for assigned personnel
    $appointments->transform(function ($appointment) {
        $assigned = json_decode($appointment->assigned_personnel, true) ?? [];
        $appointment->vet_name = $assigned[0]['name'] ?? null;
        $appointment->specialization = $assigned[0]['specialization'] ?? 'General Practice';
        return $appointment;
    });

    return view('vet_appointments', compact('appointments'));
}


    // public function appointments()
    // {
    //     $query = DB::table('user_appointments as ua')
    //         ->leftJoin('pets as p', 'ua.pet_code', '=', 'p.pet_code')
    //         ->leftJoin('services as s', 'ua.reason', '=', 's.id')
    //         ->orderby('ua.appointment_date', 'desc');

    //     if (auth()->user()->role === 'admin') {
    //         $query->leftJoin('users as owner', 'ua.client_id', '=', 'owner.id')
    //             ->select(
    //                 'ua.id as appointment_id',
    //                 'ua.*',
    //                 'p.id as pet_id',
    //                 'p.name as pet_name',
    //                 'p.breed',
    //                 'p.species',
    //                 'p.sex',
    //                 'p.date_of_birth',
    //                 'owner.id as owner_id',
    //                 'owner.name as owner_name',
    //                 's.name as reason_name',
    //                 DB::raw('TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age'),
    //                 DB::raw('(SELECT JSON_ARRAYAGG(JSON_OBJECT(
    //                         "user_id", u.id,
    //                         "name", u.name,
    //                         "role", u.role
    //                     ))
    //                     FROM assigned_vet av
    //                     JOIN users u ON av.user_id = u.id
    //                     WHERE av.appointment_id = ua.id) as assigned_personnel')
    //             );
    //         } else if (auth()->user()->role === 'vet') {
    //             $query->leftJoin('users as owner', 'ua.client_id', '=', 'owner.id')
    //                 ->whereIn('ua.id', function ($sub) {
    //                     $sub->select('appointment_id')
    //                         ->from('assigned_vet')
    //                         ->where('user_id', auth()->id());
    //                 })
    //                 ->select(
    //                     'ua.id as appointment_id',
    //                     'ua.*',
    //                     'p.id as pet_id',
    //                     'p.name as pet_name',
    //                     'p.breed',
    //                     'p.species',
    //                     'p.sex',
    //                     'p.date_of_birth',
    //                     'owner.id as owner_id', 
    //                     'owner.name as owner_name',
    //                     's.name as reason_name',
    //                     DB::raw('TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age'),
    //                     DB::raw('(SELECT JSON_ARRAYAGG(JSON_OBJECT(
    //                             "user_id", u.id,
    //                             "name", u.name,
    //                             "role", u.role
    //                         ))
    //                         FROM assigned_vet av
    //                         JOIN users u ON av.user_id = u.id
    //                         WHERE av.appointment_id = ua.id) as assigned_personnel')
    //                 );
    //         }

    //     $appointments = $query->orderBy('ua.appointment_date', 'desc')->get();

    //     // Decode JSON for assigned personnel
    //     $appointments->transform(function ($appointment) {
    //          $appointment->vet_name = $appointment->assigned_personnel[0]['name'] ?? null;
    //          $appointment->specialization = $appointment->assigned_personnel[0]['specialization'] ?? 'General Practice';
    //         return $appointment;
    //     });

    //     return view('vet_appointments', compact('appointments'));
    // }

        // In VetController.php
    public function getAvailableVets()
    {
        $vets = DB::table('users as u')
            ->join('vet_profile as vp', 'vp.user_id', '=', 'u.id')
            ->select(
                'u.id',
                'u.name',
                'vp.specialization'
            )
            ->where('u.role', 'vet')
            ->get();

        return response()->json($vets);
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

    public function search(Request $request)
{
    $query = $request->input('q');

    $pets = \App\Models\Pet::where('name', 'like', "%{$query}%")
                ->orWhere('breed', 'like', "%{$query}%")
                ->get();

    $owners = \App\Models\User::where('role', 'user')
                ->where('name', 'like', "%{$query}%")
                ->get();

    $vets = \App\Models\User::where('role', 'vet')
                ->where('name', 'like', "%{$query}%")
                ->get();

    // Merge them into one collection
    $results = $pets->concat($owners)->concat($vets);

    return view('search_result', compact('query', 'results'));
}


}



