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
        $consultations = DB::table('consultations')
            ->join('users as owners', 'consultations.user_id', '=', 'owners.id')
            ->join('vet_profile', 'consultations.vet_id', '=', 'vet_profile.user_id')
            ->join('users as vets', 'vet_profile.user_id', '=', 'vets.id')
            ->join('pets', 'consultations.pet_id', '=', 'pets.id')
            ->select(
                'consultations.*',
                'owners.name as owner_name',
                'vets.name as vet_name',
                'pets.id as pet_id',
                'pets.pet_code',
                'pets.name as pet_name',
                'pets.species as pet_species',
                'pets.breed as pet_breed',
                'pets.sex as pet_sex',
                'pets.date_of_birth',
                DB::raw('TIMESTAMPDIFF(YEAR, pets.date_of_birth, CURDATE()) as pet_age')
            )
            ->orderBy('consultations.created_at', 'desc')
            ->get();

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
