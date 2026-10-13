@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Estudiantes con Declaración de Discapacidad</h2>
        <a href="{{ route('declaraciones.pdf.general') }}" class="btn btn-primary" target="_blank">
            Descargar PDF General
        </a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Tipo de discapacidad</th>
                <th>Diagnóstico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->idCedula }}</td>
                    <td>{{ $estudiante->persona->nombre ?? 'N/A' }} {{ $estudiante->persona->apellido ?? '' }}</td>
                    <td>{{ $estudiante->discapacidad->tipoDiscapacidad ?? 'N/A' }}</td>
                    <td>{{ $estudiante->declaracionDiscapacidad->diagnostico ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('declaraciones.pdf', $estudiante->idCedula) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                            Ver PDF
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay estudiantes con declaración registrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection