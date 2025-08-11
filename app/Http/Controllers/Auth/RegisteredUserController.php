<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Veterinarian;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Basic validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,vet'],
        ];

        // If registering as vet, add vet-specific validations
        if ($request->input('role') === 'vet') {
            $rules = array_merge($rules, [
                'license_number' => ['required', 'string', 'max:255', 'unique:vet_profile,license_number'],
                'clinic_name' => ['required', 'string', 'max:255'],
            ]);
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Determine role and status
        $role = $validatedData['role'];
        $status = ($role === 'vet') ? 'pending' : 'approved'; // vets start as pending

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $role,
            'status' => $status,
        ]);

        // If vet, create a vet profile linked to the user
        if ($role === 'vet') {
            Veterinarian::create([
                'user_id' => $user->id,
                'license_number' => $validatedData['license_number'],
                'clinic_name' => $validatedData['clinic_name'],
                'is_active' => false, 
            ]);
        }

        // Fire registered event
        event(new Registered($user));

            Auth::login($user);
            return redirect(route('dashboard'));
        

    }
}
