<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function pets()
    {
        $pets = Pet::where('owner_id', auth()->id())->get();
        return view('user_pets', compact('pets'));
    }
}


