<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Show the form to create a new appointment.
     * This view contains the input fields to book a new appointment.
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Handle the form submission for creating a new appointment.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'pet_name' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'notes' => 'nullable|string',
        ]);

        // Create a new appointment record in the database
        Appointment::create([
            'user_id' => Auth::id(), // Assign the logged-in user as the owner
            'pet_name' => $request->pet_name,
            'service' => $request->service,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'notes' => $request->notes,
        ]);

        // Redirect back to the appointment form with a success message
        return redirect()->route('appointments.create')->with('success', 'Appointment booked successfully!');
    }

    /**
     * Display a list of all appointments booked by the current user.
     */
    public function index()
    {
        // Get appointments for the authenticated user only
        $appointments = Appointment::where('user_id', Auth::id())->latest()->get();

        // Return the view with the appointments data
        return view('appointments.index', compact('appointments'));
    }
}
