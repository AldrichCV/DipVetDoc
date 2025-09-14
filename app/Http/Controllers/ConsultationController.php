<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class ConsultationController extends Controller
{
 public function index()
{
    $consultations = DB::table('user_appointments as ua')
        ->join('assigned_vet as av', 'ua.id', '=', 'av.appointment_id') 
        ->join('pets', 'ua.pet_code', '=', 'pets.pet_code')
        ->join('users as owners', 'pets.owner_id', '=', 'owners.id')
        ->leftJoin('medical_consultations as mc', 'pets.id', '=', 'mc.pet_id')
        ->join('users as vets', 'av.user_id', '=', 'vets.id')
        ->select(
            'pets.id as pet_id',
            'pets.pet_code',
            'pets.name as pet_name',
            'pets.species as pet_species',
            'pets.breed as pet_breed',
            'pets.sex as pet_sex',
            'pets.date_of_birth',
            'owners.name as owner_name',
            'vets.name as vet_name',
            'mc.id as consultation_id',
            'mc.body_weight',
            'mc.respiratory_rate',
            'mc.temperature',
            'mc.complaint',
            'mc.medication',
            'mc.prescription',
            'mc.status',
            'mc.created_at',
            DB::raw('TIMESTAMPDIFF(YEAR, pets.date_of_birth, CURDATE()) as pet_age')
        )
        ->when(auth()->user()->role !== 'admin', function ($query) {
            return $query->where('av.user_id', Auth::id());
        })
        ->orderBy('mc.created_at', 'desc')
        ->get()
        ->groupBy('pet_id')
        ->map(function ($c) {
            return $c->values();
        })
        ->values();

    // If AJAX request, return only the inner Blade (no full layout)
  

    // Otherwise return full page
    return view('consultations', compact('consultations'));
}

    public function store(Request $request)
    {
       $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'diagnosis' => 'nullable|string',
        'treatment' => 'nullable|string',
    ]);

    $pet = Pet::findOrFail($request->pet_id);

    $consultation = Consultation::create([
        'pet_id' => $pet->id,
        'user_id' => $pet->owner_id,
        'vet_id' => Auth::id(),
        'diagnosis' => $request->diagnosis,
        'treatment' => $request->treatment,
        'status' => 'ongoing',
    ]);

    return redirect()->back()->with('success', 'Consultation created successfully.');

    }

   public function download($petId)
{
    $consultations = DB::table('medical_consultations as mc')
        ->join('pets', 'mc.pet_id', '=', 'pets.id')
        ->join('users as vets', 'mc.vet_id', '=', 'vets.id')
        ->join('users as owners', 'pets.owner_id', '=', 'owners.id')
        ->where('pets.id', $petId)
        ->select(
            'pets.id as pet_id',
            'pets.name as pet_name',
            'pets.species as pet_species',
            'pets.breed as pet_breed',
            'pets.sex as pet_sex',
            'pets.date_of_birth',
            'owners.name as owner_name',
            'vets.name as vet_name',
            'mc.body_weight',
            'mc.respiratory_rate',
            'mc.temperature',
            'mc.complaint',
            'mc.medication',
            'mc.prescription',
            'mc.created_at'
        )
        ->get();

    if ($consultations->isEmpty()) {
        return redirect()->back()->with('error', 'No consultations found.');
    }

    $pet = $consultations->first();

    $pdf = Pdf::loadView('pdf.consultations', [
        'pet' => $pet,
        'consultations' => $consultations
    ]);

    return $pdf->download($pet->pet_name . '-consultations.pdf');
}
}
