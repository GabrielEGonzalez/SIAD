<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .titulo {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .encabezado {
            text-align: center;
            margin-bottom: 25px;
        }

        .seccion {
            margin-bottom: 20px;
        }

        .seccion h3 {
            font-size: 14px;
            border-bottom: 1px solid #444;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table td {
            padding: 5px;
            border: 1px solid #999;
        }

        .firma {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="encabezado">
        <h2>UNIVERSIDAD - DEPARTAMENTO DE APOYO</h2>
        <p><strong>Reporte del Caso N° {{ $caso->id_casos }}</strong></p>
        <hr>
    </div>

    <div class="seccion">
        <h3>Datos del Estudiante</h3>
        <table>
            <tr><td><strong>Nombre:</strong></td><td>{{ $estudiante->persona->nombre }} {{ $estudiante->persona->apellido }}</td></tr>
            <tr><td><strong>Cédula:</strong></td><td>{{ $estudiante->idCedula }}</td></tr>
            <tr><td><strong>Correo:</strong></td><td>{{ $estudiante->correo_electronico }}</td></tr>
        </table>
    </div>

    <div class="seccion">
        <h3>Información del Caso</h3>
        <table>
            <tr><td><strong>Fecha Registro:</strong></td><td>{{ $caso->fechaRegistro }}</td></tr>
            <tr><td><strong>Descripción:</strong></td><td>{{ $caso->descripcion }}</td></tr>
        </table>
    </div>

    <div class="seccion">
        <h3>{{ $tipo == 'cronica' ? 'Crónica del Funcionario' : 'Seguimiento' }}</h3>
        <p>{!! nl2br(e($reporte->relato ?? $reporte->observaciones)) !!}</p>
    </div>

    <div class="firma">
        <p>_______________________________</p>
        <p><strong>Firma del responsable</strong></p>
    </div>

</body>
</html>
