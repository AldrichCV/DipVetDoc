<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
  public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,cancelled',
        ]);

        $appointment = Appointment::findOrFail($id);

        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'reason' => $request->reason,
            'status' => $request->status,
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


