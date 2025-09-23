<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Pet;
use App\Models\MedicalConsultation;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Inertia\Inertia;


class ConsultationController extends Controller
{
    public function index()
    {
         return Inertia::render('Consultations', [
            'title' => 'Consultations', // optional props
        ]);
    }

    // public function store(Request $request)
    // {
    //    $request->validate([
    //     'pet_id' => 'required|exists:pets,id',
    //     'diagnosis' => 'nullable|string',
    //     'treatment' => 'nullable|string',
    // ]);

    // $pet = Pet::findOrFail($request->pet_id);

    // $consultation = Consultation::create([
    //     'pet_id' => $pet->id,
    //     'user_id' => $pet->owner_id,
    //     'vet_id' => Auth::id(),
    //     'diagnosis' => $request->diagnosis,
    //     'treatment' => $request->treatment,
    //     'status' => 'ongoing',
    // ]);

    // return redirect()->back()->with('success', 'Consultation created successfully.');

    // }

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
