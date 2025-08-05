<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
 public function store(Request $request)
    {
        $request->validate([
            // Pet data
            'name' => 'required|string|max:100',
            'species' => 'required|string|max:100',
            'breed' => 'nullable|string|max:100',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',

            // Appointment data
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Generate Pet Code (based on date + daily counter)
            $petCode = $this->generatePetCode();

            // 2. Create Pet
            $pet = Pet::create([
                'pet_code' => $petCode,
                'name' => $request->name,
                'species' => $request->species,
                'breed' => $request->breed,
                'sex' => $request->sex,
                'date_of_birth' => $request->date_of_birth,
            ]);

            // 3. Create Appointment (linked via pet_code)
            Appointment::create([
                'pet_code' => $petCode,
                'client_id' => auth()->id(),
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'reason' => $request->reason,
                'notes' => $request->notes,
                'status' => 'pending',
                'vet_id' => null,
            ]);
        });

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    protected function generatePetCode(): string
    {
        $today = now()->format('Ymd');
        $countToday = Pet::whereDate('created_at', today())->count() + 1;

        return 'PET' . $today . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
    }
}


