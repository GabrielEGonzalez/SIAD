<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte General - Declaraciones de Discapacidad</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #222; }
        h1 { font-size: 16px; text-align: center; margin-bottom: 4px; }
        p.subtitle { text-align: center; font-size: 11px; color: #555; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 5px 6px; text-align: left; }
        th { background-color: #eee; }
        .footer { margin-top: 20px; font-size: 9px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <h1>Reporte General de Declaraciones de Discapacidad</h1>
    <p class="subtitle">Total de estudiantes: {{ $estudiantes->count() }}</p>

    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Tipo de discapacidad</th>
                <th>Diagnóstico</th>
                <th>Certificado</th>
                <th>Estado certificado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->idCedula }}</td>
                    <td>{{ $estudiante->persona->nombre ?? 'N/A' }} {{ $estudiante->persona->apellido ?? '' }}</td>
                    <td>{{ $estudiante->discapacidad->tipoDiscapacidad ?? 'N/A' }}</td>
                    <td>{{ $estudiante->declaracionDiscapacidad->diagnostico ?? 'N/A' }}</td>
                    <td>{{ $estudiante->declaracionDiscapacidad->certificado ?? 'N/A' }}</td>
                    <td>{{ $estudiante->declaracionDiscapacidad->estadoCertificado ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Documento generado automáticamente el {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>