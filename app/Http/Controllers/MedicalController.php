<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalConsultation;
use Illuminate\Support\Facades\Auth;
use App\Models\Pet;

class MedicalController extends Controller
{
    
public function store(Request $request)
{
    $request->validate([
        'pet_id'           => 'required|exists:pets,id',
        'body_weight'      => 'nullable|numeric|min:0',
        'respiratory_rate' => 'nullable|integer|min:0',
        'temperature'      => 'nullable|numeric|min:0',
        'complaint'        => 'nullable|string',
        'medication'       => 'nullable|string',
        'prescription'     => 'nullable|string',
    ]);

    // 🔍 find the pet to get its owner
    $pet = Pet::findOrFail($request->pet_id);

    $consultation = \App\Models\MedicalConsultation::create([
        'pet_id'           => $request->pet_id,
        'owner_id'         => $pet->owner_id,   // ✅ set owner
        'vet_id'           => Auth::id(),       // ✅ set vet
        'body_weight'      => $request->body_weight,
        'respiratory_rate' => $request->respiratory_rate,
        'temperature'      => $request->temperature,
        'complaint'        => $request->complaint,
        'medication'       => $request->medication,
        'prescription'     => $request->prescription,
        'status'           => 'ongoing', // default
    ]);

    return redirect()->back()->with('success', 'Consultation saved successfully!');
}
    }
