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
            'pet.consultations' => fn($q) => $q->latest()->limit(1),
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
            $consultation = $pet->consultations->first(); // latest only

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

                'consultation_id'   => $consultation->id ?? null,
                'body_weight'       => $consultation->body_weight ?? null,
                'respiratory_rate'  => $consultation->respiratory_rate ?? null,
                'temperature'       => $consultation->temperature ?? null,
                'complaint'         => $consultation->complaint ?? null,
                'medication'        => $consultation->medication ?? null,
                'prescription'      => $consultation->prescription ?? null,
                'status'            => $consultation->status ?? null,
                'created_at'        => $consultation->created_at ?? null,
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

}
