<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte General de Casos</title>
    <style>
        @page {
            margin: 25px 30px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            color: #1e293b;
            line-height: 1.4;
        }

        /* ═══════ MEMBRETE / HEADER ═══════ */
        .header {
            border-bottom: 3px solid #2563eb;
            padding-bottom: 14px;
            margin-bottom: 22px;
        }
        .header table { width: 100%; }
        .header .institution {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header .title {
            font-size: 20px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 3px;
        }
        .header .meta {
            text-align: right;
            font-size: 10px;
            color: #64748b;
        }
        .header .meta strong {
            color: #2563eb;
            font-size: 13px;
        }

        /* ═══════ SECCIONES ═══════ */
        h2 {
            font-size: 12.5px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 26px;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 1.5px solid #e2e8f0;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        h2 span.accent {
            color: #2563eb;
        }

        /* ═══════ TARJETAS RESUMEN ═══════ */
        .stats-grid { width: 100%; border-collapse: separate; border-spacing: 8px 0; }
        .stats-grid td {
            width: 25%;
            padding: 14px 10px;
            text-align: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-top: 3px solid #2563eb;
        }
        .stats-grid td.alt { border-top-color: #7c3aed; }
        .stats-grid td.alt2 { border-top-color: #f59e0b; }
        .stats-grid td.alt3 { border-top-color: #16a34a; }
        .stat-value { font-size: 24px; font-weight: bold; color: #0f172a; }
        .stat-label {
            font-size: 9px; color: #64748b; margin-top: 4px;
            text-transform: uppercase; letter-spacing: 0.5px;
        }

        /* ═══════ GRÁFICA DE BARRAS (divs, sin tablas) ═══════ */
        .chart-wrap {
            background: #fafbfc;
            border: 1px solid #e2e8f0;
            padding: 20px 10px 0;
            text-align: center;
        }
        .bar-col {
            display: inline-block;
            width: 7%;
            vertical-align: bottom;
            text-align: center;
            margin: 0 1px;
        }
        .bar-value {
            font-size: 9px;
            font-weight: bold;
            color: #2563eb;
            display: block;
            margin-bottom: 3px;
        }
        .bar-fill {
            background: #2563eb;
            width: 65%;
            margin: 0 auto;
        }
        .bar-label {
            font-size: 8.5px;
            color: #64748b;
            padding: 5px 0 12px;
            border-top: 1.5px solid #cbd5e1;
            margin-top: 4px;
        }

        /* ═══════ TABLA DE DATOS ═══════ */
        table.data { width: 100%; border-collapse: collapse; margin-top: 4px; }
        table.data th {
            background: #0f172a;
            color: #ffffff;
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 8px 8px;
            text-align: left;
        }
        table.data td {
            padding: 7px 8px;
            font-size: 10px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }
        table.data tbody tr:nth-child(even) { background: #f8fafc; }
        .badge {
            display: inline-block;
            font-size: 8.5px;
            font-weight: bold;
            padding: 2px 7px;
            border-radius: 3px;
            text-transform: uppercase;
        }
        .badge.estudiante { background: #eff6ff; color: #2563eb; }
        .badge.funcionario { background: #f5f3ff; color: #7c3aed; }

        /* ═══════ FOOTER ═══════ */
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            font-size: 8.5px;
            color: #94a3b8;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- ═══════════ ENCABEZADO ═══════════ --}}
    <div class="header">
        <table>
            <tr>
                <td>
                    <div class="institution">Universidad de Panamá · Sistema SIAD</div>
                    <div class="title">Reporte General de Casos</div>
                </td>
                <td class="meta">
                    <strong>Año {{ $anio }}</strong><br>
                    Generado el {{ now()->format('d/m/Y') }} a las {{ now()->format('H:i') }}
                </td>
            </tr>
        </table>
    </div>

    {{-- ═══════════ TARJETAS RESUMEN ═══════════ --}}
    <h2><span class="accent">01.</span> Resumen General</h2>
    <table class="stats-grid">
        <tr>
            <td>
                <div class="stat-value">{{ $totalCasos }}</div>
                <div class="stat-label">Total histórico</div>
            </td>
            <td class="alt2">
                <div class="stat-value">{{ $totalCasosAnio }}</div>
                <div class="stat-label">Casos en {{ $anio }}</div>
            </td>
            <td class="alt">
                <div class="stat-value">{{ $casosEstudiantes }}</div>
                <div class="stat-label">Casos de estudiantes</div>
            </td>
            <td class="alt3">
                <div class="stat-value">{{ $casosFuncionarios }}</div>
                <div class="stat-label">Casos de funcionarios</div>
            </td>
        </tr>
    </table>

    {{-- ═══════════ GRÁFICA DE BARRAS (divs) ═══════════ --}}
    <h2><span class="accent">02.</span> Casos registrados por mes — {{ $anio }}</h2>

    @php
        $maxValor = !empty($dataMeses) && max($dataMeses) > 0 ? max($dataMeses) : 1;
        $altoMax = 90; // px máximo de barra
    @endphp

    <div class="chart-wrap">
        @foreach ($dataMeses as $i => $valor)
            @php
                $alturaBarra = $valor > 0 ? max(round(($valor / $maxValor) * $altoMax), 4) : 0;
            @endphp
            <div class="bar-col">
                @if($valor > 0)
                    <span class="bar-value">{{ $valor }}</span>
                @else
                    <span class="bar-value">&nbsp;</span>
                @endif
                <div class="bar-fill" style="height: {{ $alturaBarra }}px;"></div>
                <div class="bar-label">{{ $meses[$i] }}</div>
            </div>
        @endforeach
    </div>

    {{-- ═══════════ LISTADO DETALLADO DE CASOS ═══════════ --}}
    <h2><span class="accent">03.</span> Detalle de Casos</h2>
    <table class="data">
        <thead>
            <tr>
                <th style="width:8%">Caso #</th>
                <th style="width:14%">Fecha</th>
                <th style="width:22%">Nombre</th>
                <th style="width:14%">Tipo</th>
                <th style="width:28%">Motivo (seguimiento)</th>
                <th style="width:14%">Responsable</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($casos as $caso)
                @php
                    $personaRelacion = $caso->personas->firstWhere('tipo', 'estudiante') ?? $caso->personas->first();
                    $persona = $personaRelacion->persona ?? null;
                    $tipoPersona = $personaRelacion->tipo ?? null;
                @endphp
                <tr>
                    <td><strong>#{{ $caso->id_casos }}</strong></td>
                    <td>{{ $caso->fechaRegistro ?? 'N/A' }}</td>
                    <td>{{ $persona->nombre ?? 'N/A' }} {{ $persona->apellido ?? '' }}</td>
                    <td>
                        @if($tipoPersona)
                            <span class="badge {{ $tipoPersona }}">{{ $tipoPersona }}</span>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $caso->seguimiento->motivo_ss ?? 'Sin seguimiento' }}</td>
                    <td>{{ $caso->seguimiento->responsableSeguimiento ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">
                        No hay casos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Documento generado automáticamente por el Sistema SIAD · Universidad de Panamá · {{ now()->format('Y') }}
    </div>

</body>
</html>