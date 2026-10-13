<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class DashboardController extends Controller
{
    public function index()
    {
        // Casos totales
        $totalCasos = DB::table('casos')->count();

        // Casos en seguimiento
        $casosEnSeguimiento = DB::table('seguimiento')
            ->distinct('id_caso')
            ->count('id_caso');

        // Casos cerrados (si agregaste el campo estado)

        // Citas del día
        if (Schema::hasTable('cita')) {
            $citasHoy = DB::table('cita')
                ->whereDate('fecha_hora', now()->toDateString())
                ->count();
        } else {
            $citasHoy = 0; // Si no existe la tabla, devolver 0
        }

        return view('admin', compact(
            'totalCasos',
            'casosEnSeguimiento',
            'citasHoy'
        ));
    }
}
