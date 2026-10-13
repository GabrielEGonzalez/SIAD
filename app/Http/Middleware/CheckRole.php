<?php
// app/Http/Middleware/CheckRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        // Leer el rol desde tu sesión manual
        $rol = session('rol_user');

        // Si no hay sesión activa, redirigir al login
        if (!$rol) {
            return redirect()->route('login')
                ->withErrors(['session' => 'Debes iniciar sesión.']);
        }

        // Verificar si el rol tiene permiso
        if (!in_array($rol, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }
}
