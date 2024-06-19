<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        $user = Socialite::driver('google')->user();

        $existingUser = User::where('google_id', $user->id)->first();

        if ($existingUser) {
            // Log in the existing user.
            auth()->login($existingUser, true);
        } else {
            // Create a new user.
            $newUser = new User();
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->google_id = $user->id;
            $newUser->password = bcrypt(request(Str::random())); // Set some random password
            $newUser->email_verified_at=Carbon::now();
            $newUser->save();

            // Log in the new user.
            auth()->login($newUser, true);
        }

         // Redirect to url as requested by user, if empty use /dashboard page as generated by Jetstream
        return redirect()->intended('/');
    }
}
