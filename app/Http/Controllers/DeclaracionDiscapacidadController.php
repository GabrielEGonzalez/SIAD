<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Barryvdh\DomPDF\Facade\Pdf;

class DeclaracionDiscapacidadController extends Controller
{
    /**
     * Lista de estudiantes que tienen declaración de discapacidad registrada.
     */
    public function index()
    {
        $estudiantes = Estudiante::with(['persona', 'declaracionDiscapacidad', 'discapacidad'])
            ->whereHas('declaracionDiscapacidad')
            ->get();

        return view('declaraciones.index', compact('estudiantes'));
    }

    /**
     * PDF individual de un estudiante.
     */
    public function pdf($idCedula)
    {
        $estudiante = Estudiante::with([
            'persona',
            'discapacidad',
            'declaracionDiscapacidad',
            'direccion',
            'situacionAcademica',
            'situacionEconomica',
            'salud',
        ])->findOrFail($idCedula);

        if (!$estudiante->declaracionDiscapacidad) {
            abort(404, 'Este estudiante no tiene una declaración de discapacidad registrada.');
        }

        $pdf = Pdf::loadView('declaraciones.pdf', compact('estudiante'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream("Declaracion-{$idCedula}.pdf");
    }

    /**
     * PDF general: listado consolidado de todos los estudiantes con declaración.
     */
    public function pdfGeneral()
    {
        $estudiantes = Estudiante::with(['persona', 'discapacidad', 'declaracionDiscapacidad'])
            ->whereHas('declaracionDiscapacidad')
            ->get();

        $pdf = Pdf::loadView('declaraciones.pdfGeneral', compact('estudiantes'))
            ->setPaper('letter', 'landscape'); // landscape porque es tabla ancha

        return $pdf->stream('Declaraciones-General.pdf');
    }
}