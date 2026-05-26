<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        string $rol
    ): Response {

        // VERIFICAR LOGIN
        if (!Auth::check()) {

            return redirect('/login');
        }

        // VERIFICAR ROL
        if (Auth::user()->rol !== $rol) {

            abort(403, 'No tienes permiso para acceder.');
        }

        return $next($request);
    }
}
