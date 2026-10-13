<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserSession
{
    public function handle(Request $request, Closure $next): Response
{
    if (!session()->has('nombre')) {
        return redirect('/')->with('error', 'Debes iniciar sesión.');
    }

    if (session('rol_user') !== 'admin') {
        return redirect('/')->with('error', 'No tienes permiso para acceder.');
    }

    return $next($request);
}

}
