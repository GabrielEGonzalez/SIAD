<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Persona;
use App\Models\Direccion;
use App\Models\SituacionAcademica;
use App\Models\Discapacidad;
use App\Models\SituacionEconomica;
use App\Models\SituacionSalud;
use App\Models\DeclaracionDiscapacidad;
use App\Models\Casos;
use App\Models\CasoPersona;

class EstudianteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'cedula' => 'required|numeric|unique:estudiante,idcedula',
            'correo' => 'nullable|email',

            'dificultad' => 'required|array',

            // ESTA ES LA CORRECCIÓN
            'observaciones' => 'nullable|array',
            'observaciones.*' => 'nullable|string|max:255',

            'tipo_discapacidad' => 'required|array',
            'observaciones_finales' => 'nullable|string|max:500',
        ]);


        DB::beginTransaction();

        try {
            // 1) persona
            $persona = Persona::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'edad' => $request->edad,
                'tipo' => 'estudiante',
            ]);

            // 2) direccion
            $direccion = Direccion::create([
                'calle' => $request->direccion_calle,
                'provincia' => $request->direccion_provincia ?? '',
                'referencia' => $request->direccion_referencia ?? '',
            ]);

            // 3) situación académica
            $sitAcad = SituacionAcademica::create([
                'facultad' => $request->facultad,
                'carrera' => $request->carrera,
                'anioIngreso' => $request->anio_ingreso,
                'anioCursa' => $request->anio_curso,
            ]);

            // 4) discapacidad
            $discap = Discapacidad::create([
                'tipoDiscapacidad' => json_encode($request->tipo_discapacidad), // Guardamos array como JSON
                'tiempoDiscapacidad' => $request->dur,
            ]);

            // 5) declaracion discapacidad
            $decl = DeclaracionDiscapacidad::create([
                'diagnostico' => json_encode($request->observaciones), // Guardamos observaciones como JSON
                'dificultad' => json_encode($request->dificultad),     // Guardamos dificultad como JSON
                'certificado' => $request->certificado ?? 'no',
                'estadoCertificado' => $request->estadoCertificado ?? 'pendiente',
            ]);

            // 6) situacion economica
            $econ = SituacionEconomica::create([
                'trabaja' => $request->trabaja,
                'especificacion' => $request->lugar_trabajo ?? '',
                'telefono' => $request->telefono_emergencia ?? '',
                'parentesco' => $request->parentesco_emergencia ?? '',
            ]);

            // 7) salud
            $salud = SituacionSalud::create([
                'telefono' => $request->telefono_emergencia ?? '',
                'especifique' => $request->especifica_terapia ?? '',
                'parentesco' => $request->parentesco_emergencia ?? '',
                'recibeTerapia' => $request->terapia ?? 'no',
            ]);

            // 8) guardar firma
            $firmaFileName = null;
            if ($request->filled('firma')) {
                $data = preg_replace('#^data:image/\w+;base64,#i', '', $request->firma);
                $decoded = base64_decode($data);
                $firmaFileName = 'firma_' . $request->cedula . '_' . time() . '.png';
                Storage::disk('public')->put('firmas/' . $firmaFileName, $decoded);
            }

            // 9) estudiante
            $estudianteId = DB::table('estudiante')->insertGetId([
                'idcedula' => $request->cedula,
                'id_persona' => $persona->id_persona,
                'idDireccion' => $direccion->idDireccion,
                'correo_electronico' => $request->correo ?? '',
                'telefonoContactoFijo' => $request->telefono_fijo ?? '',
                'telefonoContactoCelular' => $request->telefono_celular ?? '',
                'id_discapacidad' => $discap->idDiscapacidad,
                'id_situacionEconomica' => $econ->idSituacionEconomica,
                'id_salud' => $salud->idSalud,
                'comentarioAdicional' => $request->comentarios ?? '',
                'observaciones_recomendaciones' => $request->observaciones_finales ?? '',
                'firma_encargado' => $firmaFileName,
                'id_situacionAcademica' => $sitAcad->idSituacionAcademica,
                'idDeclaracionDiscapacidad' => $decl->idDeclaracionDiscapacidad,
            ]);

            // 10) crear caso
            $caso = Casos::create([
                'descripcion' => $request->descripcion_caso ?? 'Declaración generada',
            ]);

            // 11) relacion caso_persona
            CasoPersona::create([
                'id_caso' => $caso->id_casos,
                'id_persona' => $persona->id_persona,
                'tipo' => 'estudiante',
            ]);

            DB::commit();

            return redirect()->route('panel')->with('success', 'Estudiante registrado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error guardando estudiante: ' . $e->getMessage());
            return back()->withInput()->withErrors('Error al guardar: ' . $e->getMessage());
        }
    }
}
