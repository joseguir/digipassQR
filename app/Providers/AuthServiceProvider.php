<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Evento;
use App\Policies\EventoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

         Gate::define('admin', function ($user) {
            return $user->role->nombre === 'admin';
        });

        Gate::define('organizador', function ($user) {
            return $user->role->nombre === 'organizador';
        });
        // Puerta que sirve para admin y organizador
        Gate::define('admin-or-organizador', function ($user) {
            return in_array($user->role->nombre, ['admin', 'organizador']);
        });
        // Puerta que sirve para admin, organizador y cliente
        Gate::define('admin-or-organizador-or-cliente', function ($user) {
            return in_array($user->role->nombre, ['admin', 'organizador', 'cliente']);
        });

    }
}
