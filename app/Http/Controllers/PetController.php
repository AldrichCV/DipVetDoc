<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::select('pet_code', 'name', 'species', 'breed', 'sex', 'date_of_birth')->distinct()->get();
        return view('pets', compact('pets'));
    }

}
