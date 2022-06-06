<?php

namespace App\Http\Controllers\Api\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    const DRIVER_TYPE = 'google';

    public function handleGoogleRedirect()
    {
        return Socialite::driver(static::DRIVER_TYPE)->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user  = Socialite::driver(static::DRIVER_TYPE)->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt('11111111'),
                ]);
                Auth::login($newUser);
            }
            return redirect()->route('home');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
