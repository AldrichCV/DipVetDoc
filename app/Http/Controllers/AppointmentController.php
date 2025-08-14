<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function appointments()
    {
        $query = DB::table('user_appointments as ua')
            ->leftJoin('pets as p', 'ua.pet_code', '=', 'p.pet_code')
            ->leftJoin('services as s', 'ua.reason', '=', 's.id') // Join services table
            ->orderBy('ua.appointment_date', 'desc');

        // If admin, include owner name
        if (auth()->user()->role === 'admin') {
            $query->leftJoin('users as u', 'ua.client_id', '=', 'u.id')
                ->select(
                    'ua.*',
                    'p.name as pet_name',
                    'u.name as owner_name',
                    's.name as reason_name' // Service name from services table
                );
        } else {
            // Regular users only see their own appointments
            $query->where('ua.client_id', auth()->id())
                ->select(
                    'ua.*',
                    'p.name as pet_name',
                    's.name as reason_name' // Service name for display
                );
        }

        $appointments = $query->get();

        return view('user_appointments', compact('appointments'));
    }


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
                'owner_id' => auth()->id() 
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
            ]);
        });

        return redirect()->route('my_appointments.index')->with('success', 'Appointment created successfully.');
    }

    protected function generatePetCode(): string
    {
        $today = now()->format('Ymd');
        $countToday = Pet::whereDate('created_at', today())->count() + 1;

        return 'PET' . $today . '-' . str_pad($countToday, 3, '0', STR_PAD_LEFT);
    }
  
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'required|integer',
            'notes'
           
        ]);

        $appointment = Appointment::findOrFail($id);

        if ($appointment->client_id !== auth()->id()) {
            abort(403);
        }

        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'notes'=>$request->notes,
        ]);

         return redirect()->back()->with('success', 'Appointment updated successfully.');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment removed successfully.');
    }

 
}


