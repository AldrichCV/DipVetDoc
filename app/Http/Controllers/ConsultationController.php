<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
  public function index()
{
    $consultations = DB::table('user_appointments as ua')
        ->join('assigned_vet as av', 'ua.id', '=', 'av.appointment_id') 
        ->join('pets', 'ua.pet_code', '=', 'pets.pet_code')
        ->join('users as owners', 'pets.owner_id', '=', 'owners.id')
        ->leftJoin('medical_consultations as mc', 'pets.id', '=', 'mc.pet_id') // ✅ all consultations
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
        ->where('av.user_id', Auth::id())    // ✅ only pets assigned to this vet
        ->orderBy('mc.created_at', 'desc')
        ->get()
        ->groupBy('pet_id');                 // ✅ group consultations by pet

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
}
