<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\Casos;
use App\Models\Estudiante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
class SeguimientoController extends Controller
{
    // FORMULARIO DE SEGUIMIENTO
    public function create($idCaso)
    {
        $caso = Casos::with('personas.persona')->findOrFail($idCaso);

        // obtener estudiante del caso
        $persona = $caso->personas->first()->persona;

        $estudiante = Estudiante::where('id_persona', $persona->id_persona)->first();

        return view('create', compact('caso', 'estudiante'));
    }

    // GUARDAR SEGUIMIENTO

    public function store(Request $request)
    {
        // VALIDACIÓN CORRECTA
        $request->validate([
            'id_caso' => 'required|integer',
            'id_estudiante' => 'nullable|string',
            'ayudaTecnica' => 'nullable|string',
            'remitido' => 'nullable|string',               // ENUM en la BD
            'motivo_ss' => 'nullable|string',
            'accionesSeguridadR' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        // GUARDADO CORRECTO
        Seguimiento::create([
            'id_estudiante' => $request->id_estudiante,
            'id_caso' => $request->id_caso,
            'ayudaTecnica' => $request->ayudaTecnica,
            'remitido' => $request->remitido_por,              
            'motivo_ss' => $request->motivo_ss,
            'accionesSeguridadR' => $request->accionesRealizadas,
            'observaciones' => $request->observaciones,
            'firma_user' => session('nombre'),
            'fecha' => now()->format('Y-m-d'),
            'responsableSeguimiento' => session('nombre'),
        ]);

        return redirect()->route('seguimiento.historial', $request->id_caso)
            ->with('success', 'Seguimiento registrado correctamente.');
    }


    // HISTORIAL DE SEGUIMIENTOS
    public function historial($idCaso)
    {
        $caso = Casos::findOrFail($idCaso);

        $seguimientos = Seguimiento::where('id_caso', $idCaso)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('historial', compact('caso', 'seguimientos'));
    }


    public function perfil($idEstudianteEncriptado)
    {
        try {
            $idEstudiante = Crypt::decryptString($idEstudianteEncriptado);
        } catch (\Exception $e) {
            abort(404); // si manipulan la URL
        }

        $estudiante = Estudiante::with(['direccion', 'situacionAcademica'])
            ->where('idCedula', $idEstudiante)
            ->firstOrFail();

        return view('perfil', compact('estudiante'));
    }

}
