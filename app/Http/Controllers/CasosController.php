<?php

namespace App\Http\Controllers;

use App\Models\Casos;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasosController extends Controller
{
    /**
     * Mostrar la lista de casos con búsqueda y filtros
     */
    public function index(Request $request)
    {
        $query = Casos::with(['personas.persona']);

        // 🔍 BÚSQUEDA POR TEXTO (nombre, cédula, ID caso)
        if ($request->filled('search')) {
            $search = $request->input('search');
            
            $query->where(function ($q) use ($search) {
                // Buscar por ID del caso
                $q->orWhere('id_casos', 'LIKE', "%{$search}%")
                  // Buscar por nombre o apellido a través de la relación
                  ->orWhereHas('personas.persona', function ($subQ) use ($search) {
                      $subQ->where('nombre', 'LIKE', "%{$search}%")
                           ->orWhere('apellido', 'LIKE', "%{$search}%")
                           ->orWhere('idCedula', 'LIKE', "%{$search}%");
                  });
            });
        }

        // 🎯 FILTRO POR TIPO DE PERSONA
        if ($request->filled('tipo')) {
            $tipo = $request->input('tipo');
            $query->whereHas('personas.persona', function ($q) use ($tipo) {
                $q->where('tipo', $tipo);
            });
        }

        // 📅 FILTRO POR MES (opcional)
        if ($request->filled('mes')) {
            $mes = $request->input('mes');
            $query->whereMonth('fechaRegistro', $mes);
        }

        // 📅 FILTRO POR AÑO (opcional)
        if ($request->filled('anio')) {
            $anio = $request->input('anio');
            $query->whereYear('fechaRegistro', $anio);
        }

        $casosV = $query->orderBy('fechaRegistro', 'desc')->get();

        // Obtener valores para los filtros (para el select)
        $tipos = Persona::select('tipo')->distinct()->pluck('tipo');
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        $anios = Casos::select(DB::raw('YEAR(fechaRegistro) as anio'))
                    ->distinct()
                    ->orderBy('anio', 'desc')
                    ->pluck('anio');

        return view('reportes.casos', compact('casosV', 'tipos', 'meses', 'anios'));
    }
}