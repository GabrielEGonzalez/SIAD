<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Casos;
use PDF;

class ReportePDFController extends Controller
{
    public function generarPDF($idCaso)
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

        // Renderizar PDF desde una vista Blade
        $pdf = PDF::loadView('reportes.pdf', compact('caso', 'estudiante', 'reporte', 'tipo'))
            ->setPaper('letter', 'portrait'); // tamaño carta

        return $pdf->stream("Reporte-$idCaso.pdf");
        // return $pdf->download("Reporte-$idCaso.pdf");
    }

    public function listaCasos()
    {
        $casosV = Casos::with('personas.persona')->get();
        //dd($casosV->first()->personas);

        return view('casos', compact('casosV'));
    }

}
