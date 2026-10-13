<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Atención / Consulta / Seguimiento</title>
    <style>
        @page { margin: 30px 40px; }
        * { box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 13.5px;
            color: #000000;
            line-height: 1.6;
        }

        /* ═══════ ENCABEZADO INSTITUCIONAL ═══════ */
        .header-inst {
            text-align: center;
            margin-bottom: 20px;
        }
        .header-inst .l1 { font-size: 16px; font-weight: bold; letter-spacing: 0.5px; }
        .header-inst .l2 { font-size: 14px; font-weight: bold; margin-top: 3px; }
        .header-inst .l3 { font-size: 14px; font-weight: bold; margin-top: 2px; }
        .header-inst hr {
            border: none;
            border-top: 1.5px solid #000;
            margin: 12px 0 9px;
        }
        .header-inst .l4 {
            font-size: 15px;
            font-weight: bold;
            margin-top: 5px;
            text-decoration: underline;
        }

        /* ═══════ LÍNEAS DE DATOS ═══════ */
        .field-row { width: 100%; margin-bottom: 10px; }
        .field-row td { padding: 0; vertical-align: bottom; font-size: 13px; }
        .field-label { font-weight: normal; white-space: nowrap; padding-right: 5px !important; }
        .field-value {
            border-bottom: 1px solid #000;
            padding: 0 4px 2px !important;
        }

        /* ═══════ PERFIL DEL USUARIO ═══════ */
        .perfil-row {
            width: 100%;
            margin: 16px 0 18px;
        }
        .perfil-row td {
            padding: 0 18px 0 0;
            font-size: 13px;
            white-space: nowrap;
        }
        .box {
            display: inline-block;
            width: 15px;
            height: 15px;
            border: 1px solid #000;
            text-align: center;
            line-height: 14px;
            font-size: 12px;
            font-weight: bold;
            vertical-align: middle;
            margin-right: 6px;
        }

        /* ═══════ BLOQUES DE TEXTO LIBRE ═══════ */
        .block-title {
            font-size: 13.5px;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 5px;
        }
        .text-line {
            border-bottom: 1px solid #000;
            min-height: 18px;
            margin-bottom: 5px;
        }

        /* ═══════ FIRMA ═══════ */
        .firma-row {
            width: 100%;
            margin-top: 32px;
        }
        .firma-row td { font-size: 13px; vertical-align: bottom; }
        .firma-value {
            border-bottom: 1px solid #000;
            padding: 0 4px 2px !important;
        }

        /* ═══════ SECCIÓN SEGUIMIENTO ═══════ */
        .seguimiento-section {
            margin-top: 28px;
            border-top: 2px solid #000;
            padding-top: 14px;
        }
        .seguimiento-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 9px;
            color: #555;
            text-align: center;
            border-top: 1px solid #999;
            padding-top: 6px;
        }
    </style>
</head>
<body>

    @php
        $persona = $estudiante->persona ?? null;
        $perfilUsuario = $reporte->perfil_usuario ?? null;

        $tipoDisc = json_decode($estudiante->discapacidad->tipoDiscapacidad ?? '[]', true);
        $tipoDiscTexto = is_array($tipoDisc)
            ? implode(', ', array_map('ucfirst', $tipoDisc))
            : ($estudiante->discapacidad->tipoDiscapacidad ?? '');
    @endphp

    {{-- ═══════════ ENCABEZADO ═══════════ --}}
    <div class="header-inst">
        <div class="l1">UNIVERSIDAD DE PANAMÁ</div>
        <div class="l2">DESPACHO SUPERIOR</div>
        <div class="l3">OFICINA DE EQUIPARACIÓN DE OPORTUNIDADES</div>
        <hr>
        <div class="l4">REGISTRO DE ATENCIÓN / CONSULTA / SEGUIMIENTO</div>
    </div>

    {{-- ═══════════ DATOS GENERALES ═══════════ --}}
    <table class="field-row">
        <tr>
            <td class="field-label" style="width:10%">Nombre:</td>
            <td class="field-value" style="width:48%">{{ $persona->nombre ?? '' }} {{ $persona->apellido ?? '' }}</td>
            <td class="field-label" style="width:9%; padding-left:14px !important;">Cédula:</td>
            <td class="field-value">{{ $estudiante->idCedula ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:9%">Fecha:</td>
            <td class="field-value" style="width:22%">{{ $reporte->fecha ? \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') : '' }}</td>
            <td class="field-label" style="width:16%; padding-left:14px !important;">Unidad o Facultad:</td>
            <td class="field-value">{{ $estudiante->situacionAcademica->facultad ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:10%">Carrera:</td>
            <td class="field-value">{{ $estudiante->situacionAcademica->carrera ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:12%">Teléfono:</td>
            <td class="field-value" style="width:28%">{{ $estudiante->telefonoContactoCelular ?? $estudiante->telefonoContactoFijo ?? '' }}</td>
            <td class="field-label" style="width:16%; padding-left:14px !important;">Correo Electrónico:</td>
            <td class="field-value">{{ $estudiante->correo_electronico ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:18%">Tipo de Discapacidad:</td>
            <td class="field-value">{{ $tipoDiscTexto }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:12%">Ayuda Técnica:</td>
            <td class="field-value">{{ $reporte->ayudaTecnica ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:12%">Remitido por:</td>
            <td class="field-value">{{ $reporte->remitido ? ucfirst($reporte->remitido) : '' }}</td>
        </tr>
    </table>

    {{-- ═══════════ PERFIL DEL USUARIO ═══════════ --}}
    <table class="perfil-row">
        <tr>
            <td><span class="box">{{ $perfilUsuario === 'Estudiante' ? 'X' : '' }}</span>Estudiante</td>
            <td><span class="box">{{ $perfilUsuario === 'Docente' ? 'X' : '' }}</span>Docente</td>
            <td><span class="box">{{ $perfilUsuario === 'Administrativo' ? 'X' : '' }}</span>Administrativo</td>
            <td><span class="box">{{ $perfilUsuario === 'Sociedad Civil' ? 'X' : '' }}</span>Sociedad Civil</td>
        </tr>
    </table>

    {{-- ═══════════ MOTIVO ═══════════ --}}
    <p class="block-title">Motivo de solicitud de servicios</p>
    <div class="text-line">{{ $reporte->motivo_ss ?? '' }}</div>
    <div class="text-line">&nbsp;</div>
    <div class="text-line">&nbsp;</div>

    {{-- ═══════════ ACCIONES ═══════════ --}}
    <p class="block-title">Acciones realizadas / sugeridas</p>
    <div class="text-line">{{ $reporte->accionesSeguridadR ?? '' }}</div>
    <div class="text-line">&nbsp;</div>
    <div class="text-line">&nbsp;</div>

    {{-- ═══════════ OBSERVACIONES ═══════════ --}}
    <p class="block-title">Observaciones</p>
    <div class="text-line">{{ $reporte->observaciones ?? '' }}</div>
    <div class="text-line">&nbsp;</div>

    {{-- ═══════════ FIRMA ═══════════ --}}
    <table class="firma-row">
        <tr>
            <td style="width:38%">Firma del profesional responsable de la atención</td>
            <td class="firma-value">{{ $reporte->firma_user ?? '' }}</td>
        </tr>
    </table>

    {{-- ═══════════ SEGUIMIENTO ═══════════ --}}
    <div class="seguimiento-section">
        <div class="seguimiento-title">Seguimiento</div>

        <table class="field-row">
            <tr>
                <td class="field-label" style="width:10%">Fecha:</td>
                <td class="field-value" style="width:24%">{{ $reporte->fecha ? \Carbon\Carbon::parse($reporte->fecha)->format('d/m/Y') : '' }}</td>
                <td class="field-label" style="width:22%; padding-left:14px !important;">Responsable del seguimiento:</td>
                <td class="field-value">{{ $reporte->responsableSeguimiento ?? '' }}</td>
            </tr>
        </table>

        <p class="block-title">Observaciones</p>
        <div class="text-line">&nbsp;</div>
        <div class="text-line">&nbsp;</div>
        <div class="text-line">&nbsp;</div>
    </div>

    <div class="footer-note">
        Documento generado digitalmente por el Sistema SIAD — Universidad de Panamá · Caso #{{ $caso->id_casos }} · {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>