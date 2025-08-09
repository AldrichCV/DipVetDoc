<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Appointment;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::select('pet_code', 'name', 'species', 'breed', 'sex', 'date_of_birth')->distinct()->get();
        return view('pets', compact('pets'));
    }

    // Show the edit form
    public function edit($pet_code)
    {
        $pet = Pet::where('pet_code', $pet_code)->firstOrFail();

        return view('pets.edit', compact('pet'));
    }

    // Process the update form submission
    public function update(Request $request, $pet_code)
    {
        $pet = Pet::where('pet_code', $pet_code)->firstOrFail();

        // Validate input data (adjust rules as needed)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'nullable|string|max:255',
            'breed' => 'nullable|string|max:255',
            'sex' => 'nullable|in:male,female',
            'date_of_birth' => 'nullable|date',
        ]);

        // Update pet data
        $pet->update($validated);

        // Redirect back with success message
        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }


    public function destroy($pet_code)
{
    // Delete appointments first
    Appointment::where('pet_code', $pet_code)->delete();

    // Then delete the pet
    Pet::where('pet_code', $pet_code)->delete();

    return redirect()->route('my_pets')->with('success', 'Pet and related appointments deleted successfully.');
}


}
