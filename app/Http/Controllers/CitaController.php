<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class CitaController extends Controller
{

    // JSON para FullCalendar
    public function json()
    {
        $citas = Cita::all()->map(function($cita) {
            return [
                'id'    => $cita->idCita,
                'title' => $cita->titulo,
                'start' => $cita->fecha_hora,
                'color' => $cita->prioridad === 'alta' ? '#d62828' :
                            ($cita->prioridad === 'media' ? '#f77f00' : '#2a9d8f')
            ];
        });

        return response()->json($citas);
    }

        // Vista principal (form + tarjetas + calendario)
    public function index()
    {
        // Estadísticas iniciales para mostrar en la vista (opcionales)
        $total = Cita::count();
        $pendientes = Cita::where('estado', 'pendiente')->count();
        $completadas = Cita::where('estado', 'completada')->count();
        $canceladas = Cita::where('estado', 'cancelada')->count();

        return view('index', compact('total', 'pendientes', 'completadas', 'canceladas'));
    }

    // Guardar nueva cita (desde el formulario)
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string',
            'fecha_hora' => 'required|date',
            'tipo' => ['required', Rule::in(['cita','nota'])],
            'idPersona' => 'nullable|integer',
            'idUsuario' => 'nullable|integer',
            'idCaso' => 'nullable|integer',
            'prioridad' => ['required', Rule::in(['baja','media','alta'])],
            'estado' => ['required', Rule::in(['pendiente','completada','cancelada'])]
        ]);

        // Asegurar formato de fecha (opcional)
        $data['fecha_hora'] = Carbon::parse($data['fecha_hora'])->format('Y-m-d H:i:s');

        $cita = Cita::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Cita creada',
            'cita' => $cita
        ], 201);
    }

    // Endpoint: eventos para el calendario (JSON)
    public function events(Request $request)
    {
        // Trae todas las citas (puedes filtrar rango con request start/end si usa FullCalendar)
        $query = Cita::query();

        // Si vienen start/end en query (iso8601) filtramos:
        if ($request->has('start') && $request->has('end')) {
            $start = Carbon::parse($request->get('start'))->startOfDay();
            $end = Carbon::parse($request->get('end'))->endOfDay();
            $query->whereBetween('fecha_hora', [$start, $end]);
        }

        $citas = $query->get();

        // Mapear al formato de FullCalendar
        $events = $citas->map(function ($c) {
            return [
                'id' => $c->idCita,
                'title' => $c->titulo,
                'start' => $c->fecha_hora,
                'allDay' => false,
                'extendedProps' => [
                    'tipo' => $c->tipo,
                    'prioridad' => $c->prioridad,
                    'estado' => $c->estado,
                    'descripcion' => $c->descripcion,
                    'idPersona' => $c->idPersona,
                    'idUsuario' => $c->idUsuario,
                    'idCaso' => $c->idCaso
                ]
            ];
        });

        return response()->json($events);
    }

    // Endpoint: estadísticas para tarjetas (estado y prioridad)
    public function summary()
    {
        $byEstado = Cita::selectRaw('estado, COUNT(*) as total')
            ->groupBy('estado')
            ->pluck('total', 'estado');

        $byPrioridad = Cita::selectRaw('prioridad, COUNT(*) as total')
            ->groupBy('prioridad')
            ->pluck('total', 'prioridad');

        // Garantizar claves aunque no existan
        $estados = [
            'pendiente' => $byEstado->get('pendiente', 0),
            'completada' => $byEstado->get('completada', 0),
            'cancelada' => $byEstado->get('cancelada', 0),
        ];

        $prioridades = [
            'alta' => $byPrioridad->get('alta', 0),
            'media' => $byPrioridad->get('media', 0),
            'baja' => $byPrioridad->get('baja', 0),
        ];

        return response()->json([
            'estados' => $estados,
            'prioridades' => $prioridades,
            'total' => Cita::count()
        ]);
    }

    // Opcional: actualizar estado (marcar completada)
    public function updateState(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $data = $request->validate([
            'estado' => ['required', Rule::in(['pendiente','completada','cancelada'])]
        ]);

        $cita->update(['estado' => $data['estado']]);

        return response()->json(['success' => true, 'cita' => $cita]);
    }

    // Opcional: eliminar
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return response()->json(['success' => true]);
    }
    public function apiCitas()
{
    $citas = Cita::select(
        'idCita as id',
        'titulo as title',
        'fecha_hora as start',
        'prioridad',
        'estado'
    )->get();

    // Puedes añadir colores dinámicos según prioridad
    $citas->transform(function ($cita) {

        if ($cita->prioridad === 'alta') {
            $cita->color = '#d32f2f'; // rojo
        } elseif ($cita->prioridad === 'media') {
            $cita->color = '#f9a825'; // amarillo
        } else {
            $cita->color = '#388e3c'; // verde
        }

        return $cita;
    });

    return response()->json($citas);
}

}
