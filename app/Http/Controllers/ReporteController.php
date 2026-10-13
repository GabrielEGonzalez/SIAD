<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casos;
use PDF;
use Illuminate\Support\Facades\DB;
class ReporteController extends Controller
{
    public function pdf($idCaso)
    {
        $caso = Casos::findOrFail($idCaso);

        $estudiante = $caso->personas()
            ->where('tipo', 'estudiante')
            ->first()
            ->estudiante;

        if ($caso->cronicaFuncionario) {
            $tipo = 'cronica';
            $reporte = $caso->cronicaFuncionario;
        } else {
            $tipo = 'seguimiento';
            $reporte = $caso->seguimiento;
        }

        $pdf = \PDF::loadView('reportes.pdf', compact('caso', 'estudiante', 'reporte', 'tipo'))
            ->setPaper('letter', 'portrait');

        return $pdf->download('reporte-' . $caso->id_casos . '.pdf');
    }

    public function show($idCaso)
    {
        $caso = Casos::findOrFail($idCaso);

        $estudiante = $caso->personas()
            ->where('tipo', 'estudiante')
            ->first()
            ->estudiante;

        // Detectar si el caso tiene crónica o seguimiento
        if ($caso->cronicaFuncionario) {
            $tipo = 'cronica';
            $reporte = $caso->cronicaFuncionario;
        } else {
            $tipo = 'seguimiento';
            $reporte = $caso->seguimiento;
        }
        dd($caso->personas);

        return view('reportes.show', compact('caso', 'estudiante', 'reporte', 'tipo'));
    }

   public function index()
{
    // Meses fijos en nombre
    $meses = [
        'Enero', 'Febrero', 'Marzo', 'Abril',
        'Mayo', 'Junio', 'Julio', 'Agosto',
        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    // Total de casos
    $totalCasos = Casos::count();

    // Contar casos agrupados por mes
    $casosPorMes = Casos::selectRaw("MONTH(fechaRegistro) as mes, COUNT(*) as total")
                        ->groupBy('mes')
                        ->pluck('total', 'mes');

    // Crear array de 12 posiciones (si no existe mes = 0)
    $dataMeses = [];
    foreach (range(1, 12) as $numMes) {
        $dataMeses[] = $casosPorMes[$numMes] ?? 0;  // 0 si no existe
    }

    // Conteo estudiantes y funcionarios
    $casosEstudiantes = DB::table('caso_persona')
        ->where('tipo', 'estudiante')
        ->count();

    $casosFuncionarios = DB::table('caso_persona')
        ->where('tipo', 'funcionario')
        ->count();

    return view('lista', [
        'totalCasos' => $totalCasos,
        'labelsMeses' => $meses,
        'dataMeses' => $dataMeses,
        'casosEstudiantes' => $casosEstudiantes,
        'casosFuncionarios' => $casosFuncionarios
    ]);
}


public function pdfGeneral()
{
    $casos = Casos::all();
    $pdf = Pdf::loadView('reportes.pdfGeneral', compact('casos'));
    return $pdf->stream('Reporte-General.pdf');
}


}
