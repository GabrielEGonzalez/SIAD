@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="mb-4">Vista previa del reporte</h2>

        <!-- Datos del estudiante -->
        <div class="card mb-4">
            <div class="card-header">Datos del Estudiante</div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $estudiante->persona->nombre }} {{ $estudiante->persona->apellido }}</p>
                <p><strong>Cédula:</strong> {{ $estudiante->idCedula }}</p>
                <p><strong>Correo:</strong> {{ $estudiante->correo_electronico }}</p>
                <p><strong>Teléfono:</strong> {{ $estudiante->telefonoContactoCelular }}</p>

                <p><strong>Dirección:</strong>
                    {{ $estudiante->direccion->calle }},
                    {{ $estudiante->direccion->provincia }},
                    {{ $estudiante->direccion->referencia }}
                </p>

                <p><strong>Carrera:</strong> {{ $estudiante->situacionAcademica->carrera }}</p>
                <p><strong>Facultad:</strong> {{ $estudiante->situacionAcademica->facultad }}</p>
            </div>
        </div>

        <!-- Datos del caso -->
        <div class="card mb-4">
            <div class="card-header">Información del Caso</div>
            <div class="card-body">
                <p><strong>ID Caso:</strong> {{ $caso->id_casos }}</p>
                <p><strong>Fecha Registro:</strong> {{ $caso->fechaRegistro }}</p>
                <p><strong>Descripción:</strong> {{ $caso->descripcion }}</p>
            </div>
        </div>

        <!-- Tipo de reporte -->
        @if ($tipo == 'cronica')
            <div class="card mb-4">
                <div class="card-header">Crónica del Funcionario</div>
                <div class="card-body">
                    <p><strong>Relato:</strong> {{ $reporte->relato }}</p>
                    <p><strong>Elaborado por:</strong> {{ $reporte->elaborado_por }}</p>
                    <p><strong>Cargo:</strong> {{ $reporte->cargo }}</p>
                    <p><strong>Fecha:</strong> {{ $reporte->fecha_elaboracion }}</p>
                </div>
            </div>
        @endif

        @if ($tipo == 'seguimiento')
            <div class="card mb-4">
                <div class="card-header">Reporte de Seguimiento</div>
                <div class="card-body">
                    <p><strong>Ayuda técnica:</strong> {{ $reporte->ayudaTecnica }}</p>
                    <p><strong>Remitido a:</strong> {{ $reporte->remitido }}</p>
                    <p><strong>Motivo:</strong> {{ $reporte->motivo_ss }}</p>
                    <p><strong>Acciones:</strong> {{ $reporte->accionesSeguridadR }}</p>
                    <p><strong>Observaciones:</strong> {{ $reporte->observaciones }}</p>
                    <p><strong>Fecha:</strong> {{ $reporte->fecha }}</p>
                    <p><strong>Responsable:</strong> {{ $reporte->responsableSeguimiento }}</p>
                </div>
            </div>
        @endif

        <!-- Botón para generar PDF -->
        <a href="{{ route('reportes.pdf', $caso->id_casos) }}" class="btn btn-danger" target="_blank">
            <i class="bi bi-file-earmark-pdf-fill"></i> Descargar PDF
        </a>


    </div>
@endsection