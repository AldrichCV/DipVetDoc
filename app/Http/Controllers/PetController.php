<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all(); // Or paginate if needed
        return view('pets', compact('pets')); // Adjust path if needed
    }
}
