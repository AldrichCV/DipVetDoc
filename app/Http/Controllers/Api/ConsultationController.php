<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Pet;
use Illuminate\Http\JsonResponse;

class ConsultationController extends Controller
{
    public function index()
{
    $consultations = Appointment::with([
        'pet.owner',
        'pet.consultations' => fn($q) => $q->latest(),
        'assignedVet.vet',
    ])
    ->when(auth()->user()->role !== 'admin', fn($q) =>
        $q->whereHas('assignedVet', fn($sub) =>
            $sub->where('user_id', auth()->id())
        )
    )
    ->latest()
    ->get()
    ->unique('pet.id')
    ->map(function ($appointment) {
        $pet = $appointment->pet;

        return [
            'pet_id'        => $pet->id,
            'pet_code'      => $pet->pet_code,
            'pet_name'      => $pet->name,
            'pet_species'   => $pet->species,
            'pet_breed'     => $pet->breed,
            'pet_sex'       => $pet->sex,
            'date_of_birth' => $pet->date_of_birth,
            'pet_age'       => $pet->date_of_birth ? $pet->date_of_birth->diffInYears(now()) : null,

            'owner_name'    => $pet->owner->name ?? null,
            'vet_name'      => $appointment->assignedVet->vet->name ?? null,

            // Pass full history
            'consultations' => $pet->consultations->map(fn($c) => [
                'id'               => $c->id,
                'body_weight'      => $c->body_weight,
                'respiratory_rate' => $c->respiratory_rate,
                'temperature'      => $c->temperature,
                'complaint'        => $c->complaint,
                'medication'       => $c->medication,
                'prescription'     => $c->prescription,
                'status'           => $c->status,
                'created_at'       => $c->created_at,
            ]),
        ];
    })
    ->values();

    $allSpecies = Pet::distinct()->pluck('species');

    return response()->json([
        'success' => true,
        'consultations' => $consultations,
        'all_species'   => $allSpecies,
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'pet_id'    => 'required|exists:pets,id',
        'diagnosis' => 'nullable|string',
        'treatment' => 'nullable|string',
    ]);

    $pet = Pet::findOrFail($request->pet_id);

    $consultation = Consultation::create([
        'pet_id'    => $pet->id,
        'user_id'   => $pet->owner_id,
        'vet_id'    => Auth::id(),
        'diagnosis' => $request->diagnosis,
        'treatment' => $request->treatment,
        'status'    => 'ongoing',
    ]);

    return response()->json([
        'success'      => true,
        'message'      => 'Consultation created successfully.',
        'consultation' => $consultation,
    ], 201); // 201 = Created
}


}
