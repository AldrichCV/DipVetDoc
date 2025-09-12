<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Pet;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    public function index(): JsonResponse
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

    return response()->json([
        'status' => 'success',
        'data' => $appointments
    ]);
}

        public function store(Request $request)
    {
        $validated = $request->validate([
            // Pet data
            'name' => 'required|string|max:100',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',

            // Appointment data
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'required|integer|exists:services,id',
            'notes' => 'nullable|string',
        ]);

        $appointment = DB::transaction(function () use ($validated) {
            // 1. Generate Pet Code
            $petCode = $this->generatePetCode();

            // 2. Create Pet
            $pet = Pet::create([
                'pet_code' => $petCode,
                'name' => $validated['name'],
                'species' => $validated['species'],
                'breed' => $validated['breed'] ?? null,
                'sex' => $validated['sex'],
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'owner_id' => auth()->id(), // assumes API auth
            ]);

            // 3. Create Appointment
            return Appointment::create([
                'pet_code' => $petCode,
                'client_id' => auth()->id(), // assumes API auth
                'appointment_date' => $validated['appointment_date'],
                'appointment_time' => $validated['appointment_time'],
                'reason' => $validated['reason'],
                'notes' => $validated['notes'] ?? null,
                'status' => 'pending',
            ]);
        });

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment,
        ], 201);
    }

    /**
     * Generate a unique pet code based on today's date and counter
     */
    protected function generatePetCode(): string
    {
        $today = now()->format('Ymd');
        $countToday = Pet::whereDate('created_at', today())->count() + 1;

        return 'PET' . $today . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
    }
}