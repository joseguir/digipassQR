<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
       $googleUser = Socialite::driver('google')->stateless()->user();

        // ️ Buscar usuario por google_id
        $user = User::where('google_id', $googleUser->getId())->first();

        // 2 Si no existe, buscar por email
        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            // Si existe, asociar google_id
            if ($user) {
                $user->google_id = $googleUser->getId();
                $user->save();
            }
        }

        // 3 Si no existe usuario, crearlo
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(str()->random(16)), // contraseña random
                'google_id' => $googleUser->getId(),
            ]);
        }

        // 4 Loguear al usuario
        Auth::login($user);

        // 5 Redirigir al dashboard u otra ruta
        return redirect('/admin');
    }
}
