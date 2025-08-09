<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
       $googleUser = Socialite::driver('google')->stateless()->user();


        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'      => $googleUser->getName(),
                'password'  => Hash::make(Str::random(24)),
                'google_id' => $googleUser->getId(),
                'auth_provider' => 'google'
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
