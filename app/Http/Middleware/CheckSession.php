<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    public function handle(Request $request, Closure $next): mixed
    {
      /*dd([
        'idUsuario' => session('idUsuario'),
        'rol_user'  => session('rol_user'),
        'nombre'    => session('nombre'),
        'all'       => session()->all(),
    ]);*/
        if (!session('idUsuario')) {
            return redirect()->route('login')
                ->withErrors(['session' => 'Tu sesión ha expirado.']);
        }

        return $next($request);
    }
}
