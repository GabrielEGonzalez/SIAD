<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casos;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function show($idCaso)
    {
        $caso = Casos::findOrFail($idCaso);

        $personaEstudiante = $caso->personas()
            ->where('tipo', 'estudiante')
            ->first();

        if (!$personaEstudiante || !$personaEstudiante->persona || !$personaEstudiante->persona->estudiante) {
            abort(404, 'No se encontró información del estudiante para este caso.');
        }

        $estudiante = $personaEstudiante->persona->estudiante;

        $reporte = $caso->seguimiento;

        if (!$reporte) {
            abort(404, 'Este caso no tiene seguimiento registrado.');
        }

        $tipo = 'seguimiento';

        return view('reportes.show', compact('caso', 'estudiante', 'reporte', 'tipo'));
    }

    public function index($anio = null)
    {
        $anio = $anio ?? now()->year;

        $meses = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ];

        $aniosDisponibles = Casos::selectRaw('YEAR(fechaRegistro) as anio')
            ->distinct()
            ->orderByDesc('anio')
            ->pluck('anio');

        $totalCasos = Casos::count();

        $totalCasosAnio = Casos::whereYear('fechaRegistro', $anio)->count();

        $casosPorMes = Casos::selectRaw('MONTH(fechaRegistro) as mes, COUNT(*) as total')
            ->whereYear('fechaRegistro', $anio)
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $dataMeses = [];
        foreach (range(1, 12) as $numMes) {
            $dataMeses[] = $casosPorMes[$numMes] ?? 0;
        }

        $casosEstudiantes = DB::table('caso_persona')
            ->join('casos', 'casos.id_casos', '=', 'caso_persona.id_caso')
            ->where('caso_persona.tipo', 'estudiante')
            ->whereYear('casos.fechaRegistro', $anio)
            ->count();

        $casosFuncionarios = DB::table('caso_persona')
            ->join('casos', 'casos.id_casos', '=', 'caso_persona.id_caso')
            ->where('caso_persona.tipo', 'funcionario')
            ->whereYear('casos.fechaRegistro', $anio)
            ->count();

        return view('lista', [
            'anioSeleccionado' => $anio,
            'aniosDisponibles' => $aniosDisponibles,
            'totalCasos' => $totalCasos,
            'totalCasosAnio' => $totalCasosAnio,
            'labelsMeses' => $meses,
            'dataMeses' => $dataMeses,
            'casosEstudiantes' => $casosEstudiantes,
            'casosFuncionarios' => $casosFuncionarios,
        ]);
    }

    /*public function pdfGeneral()
    {
        $casos = Casos::with('personas.persona', 'seguimiento')->get();

        $pdf = Pdf::loadView('reportes.pdfGeneral', compact('casos'));

        return $pdf->stream('Reporte-General.pdf');
    }*/

    public function pdfGeneral($anio = null)
    {
        $anio = $anio ?? now()->year;

        $meses = [
            'Ene',
            'Feb',
            'Mar',
            'Abr',
            'May',
            'Jun',
            'Jul',
            'Ago',
            'Sep',
            'Oct',
            'Nov',
            'Dic'
        ];

        $casos = Casos::with('personas.persona', 'seguimiento')->get();

        $totalCasos = Casos::count();
        $totalCasosAnio = Casos::whereYear('fechaRegistro', $anio)->count();

        $casosPorMes = Casos::selectRaw('MONTH(fechaRegistro) as mes, COUNT(*) as total')
            ->whereYear('fechaRegistro', $anio)
            ->groupBy('mes')
            ->pluck('total', 'mes');

        $dataMeses = [];
        foreach (range(1, 12) as $numMes) {
            $dataMeses[] = $casosPorMes[$numMes] ?? 0;
        }

        $casosEstudiantes = DB::table('caso_persona')
            ->join('casos', 'casos.id_casos', '=', 'caso_persona.id_caso')
            ->where('caso_persona.tipo', 'estudiante')
            ->whereYear('casos.fechaRegistro', $anio)
            ->count();

        $casosFuncionarios = DB::table('caso_persona')
            ->join('casos', 'casos.id_casos', '=', 'caso_persona.id_caso')
            ->where('caso_persona.tipo', 'funcionario')
            ->whereYear('casos.fechaRegistro', $anio)
            ->count();

        $pdf = Pdf::loadView('reportes.pdfGeneral', compact(
            'casos',
            'anio',
            'totalCasos',
            'totalCasosAnio',
            'meses',
            'dataMeses',
            'casosEstudiantes',
            'casosFuncionarios'
        ))->setPaper('letter', 'landscape');

        return $pdf->stream('Reporte-General.pdf');
    }
}