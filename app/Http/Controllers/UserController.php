<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function pets()
    {
        $pets = Pet::where('owner_id', auth()->id())->get();
        return view('user_pets', compact('pets'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', 'in:user,staff'],
        ]);

        $user->role = $request->role;
        $user->save();

        return back()->with('status', 'User role updated successfully.');
    }

    public function userRedirect()
    {
        $role = Auth::user()->role ?? 'user';

        return match ($role) {
            'admin' => view('dashboard'),
            'vet' => view('veterinarian_dashboard'),
            'user'  => view('user_dashboard'),
            default => redirect('/'),
        };
    }

}