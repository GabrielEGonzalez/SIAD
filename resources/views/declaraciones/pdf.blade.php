<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Declaración de Discapacidad</title>
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

        .intro-text {
            font-size: 12px;
            text-align: justify;
            margin-bottom: 20px;
        }

        /* ═══════ SECCIONES ═══════ */
        h3.section-title {
            font-size: 13.5px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        /* ═══════ LÍNEAS DE DATOS (campo: ___valor___) ═══════ */
        .field-row { width: 100%; margin-bottom: 9px; }
        .field-row td { padding: 0; vertical-align: bottom; font-size: 13px; }
        .field-label { font-weight: normal; white-space: nowrap; padding-right: 5px !important; }
        .field-value {
            border-bottom: 1px solid #000;
            padding: 0 4px 2px !important;
        }

        /* ═══════ TABLA DE DIFICULTADES ═══════ */
        table.dificultades {
            width: 100%;
            border-collapse: collapse;
            margin: 7px 0 14px;
        }
        table.dificultades th, table.dificultades td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 12px;
        }
        table.dificultades th {
            font-weight: bold;
            text-align: center;
        }
        table.dificultades td.check { text-align: center; width: 34px; font-weight: bold; }
        table.dificultades td.item { width: 34%; }

        /* ═══════ CASILLA (checkbox con X simple) ═══════ */
        .box {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            text-align: center;
            line-height: 13px;
            font-size: 11px;
            font-weight: bold;
            vertical-align: middle;
        }

        .linea {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 230px;
            padding-bottom: 1px;
        }

        /* ═══════ COMENTARIOS ═══════ */
        .comment-line {
            border-bottom: 1px solid #000;
            min-height: 17px;
            margin-bottom: 6px;
        }

        /* ═══════ FIRMA ═══════ */
        .firma-box {
            margin-top: 44px;
            width: 280px;
        }
        .firma-line { border-top: 1px solid #000; padding-top: 4px; font-size: 12px; text-align: center; }

        /* ═══════ SECCIÓN OEO ═══════ */
        .oeo-section {
            margin-top: 26px;
            border-top: 2px solid #000;
            padding-top: 12px;
        }
        .oeo-title {
            font-size: 13.5px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 14px;
        }

        .footer-note {
            margin-top: 28px;
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
        $tiposDiscapacidad = json_decode($estudiante->discapacidad->tipoDiscapacidad ?? '[]', true) ?: [];
        $tipoDiscapacidadTexto = !empty($tiposDiscapacidad) ? implode(', ', array_map('ucfirst', $tiposDiscapacidad)) : '';

        $diagnosticoJson = json_decode($estudiante->declaracionDiscapacidad->diagnostico ?? '{}', true) ?: [];
        $dificultadJson  = json_decode($estudiante->declaracionDiscapacidad->dificultad ?? '{}', true) ?: [];

        $itemsDificultad = [
            'leer'      => 'Leer aún con anteojos o lentes puestos',
            'oir'       => 'Oír aún cuando usa audífonos',
            'caminar'   => 'Caminar o subir escalones',
            'agarrar'   => 'Agarrar objetos y/o abrir recipientes con las manos',
            'aprender'  => 'Aprender',
            'otra'      => 'Otra',
        ];

        $certificado = strtolower($estudiante->declaracionDiscapacidad->certificado ?? '');
        $estadoCert  = strtolower($estudiante->declaracionDiscapacidad->estadoCertificado ?? '');
        $recibeTerapia = strtolower($estudiante->salud->recibeTerapia ?? '');
        $trabaja = strtolower($estudiante->situacionEconomica->trabaja ?? '');
    @endphp

    {{-- ═══════════ ENCABEZADO ═══════════ --}}
    <div class="header-inst">
        <div class="l1">UNIVERSIDAD DE PANAMÁ</div>
        <div class="l2">DESPACHO SUPERIOR</div>
        <div class="l3">OFICINA DE EQUIPARACIÓN DE OPORTUNIDADES</div>
        <hr>
        <div class="l4">DECLARACIÓN DE DISCAPACIDAD</div>
    </div>

    <p class="intro-text">
        Respetado estudiante: Con la finalidad de dirigir los esfuerzos de la institución a las necesidades reales
        de nuestros estudiantes en condición de discapacidad, hemos diseñado el presente formulario. Le
        agradecemos responder las siguientes preguntas con sinceridad. Los datos recopilados serán manejados
        con discreción.
    </p>

    {{-- ═══════════ 1. DATOS GENERALES ═══════════ --}}
    <h3 class="section-title">1. Datos Generales</h3>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:12%">Apellido:</td>
            <td class="field-value" style="width:38%">{{ $estudiante->persona->apellido ?? '' }}</td>
            <td class="field-label" style="width:10%; padding-left:14px !important;">Nombre:</td>
            <td class="field-value">{{ $estudiante->persona->nombre ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:8%">Edad:</td>
            <td class="field-value" style="width:15%">{{ $estudiante->persona->edad ?? '' }}</td>
            <td class="field-label" style="width:10%; padding-left:14px !important;">Cédula:</td>
            <td class="field-value">{{ $estudiante->idCedula ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:12%">Dirección:</td>
            <td class="field-value">
                {{ $estudiante->direccion->calle ?? '' }}{{ $estudiante->direccion->provincia ? ', ' . $estudiante->direccion->provincia : '' }}
                {{ $estudiante->direccion->referencia ? ' (' . $estudiante->direccion->referencia . ')' : '' }}
            </td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:24%">Teléfono de contacto (fijo):</td>
            <td class="field-value" style="width:18%">{{ $estudiante->telefonoContactoFijo ?? '' }}</td>
            <td class="field-label" style="width:24%; padding-left:14px !important;">Teléfono de contacto (celular):</td>
            <td class="field-value">{{ $estudiante->telefonoContactoCelular ?? '' }}</td>
        </tr>
    </table>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:15%">Correo electrónico:</td>
            <td class="field-value">{{ $estudiante->correo_electronico ?? '' }}</td>
        </tr>
    </table>

    {{-- ═══════════ 2. SITUACIÓN ACADÉMICA ═══════════ --}}
    <h3 class="section-title">2. Situación Académica</h3>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:10%">Facultad:</td>
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
            <td class="field-label" style="width:15%">Año de ingreso:</td>
            <td class="field-value" style="width:20%">{{ $estudiante->situacionAcademica->anioIngreso ?? '' }}</td>
            <td class="field-label" style="width:15%; padding-left:14px !important;">Año que cursa:</td>
            <td class="field-value">{{ $estudiante->situacionAcademica->anioCursa ?? '' }}</td>
        </tr>
    </table>

    {{-- ═══════════ 3. DISCAPACIDAD ═══════════ --}}
    <h3 class="section-title">3. Discapacidad</h3>

    <table class="field-row">
        <tr>
            <td class="field-label" style="width:18%">Tipo de discapacidad:</td>
            <td class="field-value">{{ $tipoDiscapacidadTexto ?: '' }}</td>
        </tr>
    </table>

    <p style="font-size:12.5px; margin: 10px 0 5px;">Tiene dificultad o limitación permanente para:</p>

    <table class="dificultades">
        <tr>
            <th style="width:8%">SÍ</th>
            <th style="width:8%">NO</th>
            <th></th>
            <th style="width:32%">DIAGNÓSTICO</th>
        </tr>
        @foreach($itemsDificultad as $key => $etiqueta)
            @php
                $respuesta = strtolower($dificultadJson[$key] ?? '');
                $diagnosticoItem = $diagnosticoJson[$key] ?? null;
            @endphp
            <tr>
                <td class="check">{{ $respuesta === 'si' ? 'X' : '' }}</td>
                <td class="check">{{ $respuesta === 'no' ? 'X' : '' }}</td>
                <td class="item">{{ $etiqueta }}</td>
                <td>{{ $diagnosticoItem ?? '' }}</td>
            </tr>
        @endforeach
    </table>

    <p style="font-size:12.5px;">
        ¿Tiene Certificado de Discapacidad?
        &nbsp;Sí <span class="box">{{ $certificado === 'si' ? 'X' : '' }}</span>
        &nbsp;&nbsp;No <span class="box">{{ $certificado === 'no' ? 'X' : '' }}</span>
        &nbsp;&nbsp;En trámite <span class="box">{{ $estadoCert === 'pendiente' || $estadoCert === 'tramite' ? 'X' : '' }}</span>
    </p>

    {{-- ═══════════ SITUACIÓN DE SALUD ═══════════ --}}
    <h3 class="section-title">Situación de Salud</h3>

    <p style="font-size:12.5px;">
        ¿Recibe usted algún tipo de terapia?:
        &nbsp;Sí <span class="box">{{ $recibeTerapia === 'si' ? 'X' : '' }}</span>
        &nbsp;&nbsp;No <span class="box">{{ $recibeTerapia === 'no' ? 'X' : '' }}</span>
        &nbsp;&nbsp;Especifique: <span class="linea">{{ $estudiante->salud->especifique ?? '' }}</span>
    </p>

    <table class="field-row" style="margin-top:12px;">
        <tr>
            <td class="field-label" style="width:24%">En caso de emergencia llamar a: Tel</td>
            <td class="field-value" style="width:28%">{{ $estudiante->salud->telefono ?? '' }}</td>
            <td class="field-label" style="width:14%; padding-left:14px !important;">Parentesco:</td>
            <td class="field-value">{{ $estudiante->salud->parentesco ?? '' }}</td>
        </tr>
    </table>

    {{-- ═══════════ SITUACIÓN ECONÓMICO-LABORAL ═══════════ --}}
    <h3 class="section-title">Situación Económico-laboral</h3>

    <p style="font-size:12.5px;">
        ¿Trabaja?:
        &nbsp;No <span class="box">{{ $trabaja === 'no' ? 'X' : '' }}</span>
        &nbsp;&nbsp;Sí <span class="box">{{ $trabaja === 'si' ? 'X' : '' }}</span>
        &nbsp;&nbsp;Lugar: <span class="linea">{{ $estudiante->situacionEconomica->especificacion ?? '' }}</span>
    </p>

    {{-- ═══════════ COMENTARIOS ═══════════ --}}
    <h3 class="section-title">Algún otro comentario que quiera hacer o aportar:</h3>
    <div class="comment-line">{{ $estudiante->comentarioAdicional ?? '' }}</div>
    <div class="comment-line">&nbsp;</div>

    <div class="firma-box">
        <div class="firma-line">Firma</div>
    </div>

    {{-- ═══════════ SECCIÓN OEO (USO INTERNO) ═══════════ --}}
    <div class="oeo-section">
        <div class="oeo-title">Para uso del personal de la OEO</div>

        <table class="field-row">
            <tr>
                <td class="field-label" style="width:20%">Tipo de discapacidad:</td>
                <td class="field-value">{{ $tipoDiscapacidadTexto ?: '' }}</td>
            </tr>
        </table>

        <table class="field-row">
            <tr>
                <td class="field-label" style="width:32%">Tipo de discapacidad (en función del tiempo):</td>
                <td class="field-value">{{ $estudiante->discapacidad->tiempoDiscapacidad ?: '' }}</td>
            </tr>
        </table>

        <p style="font-size:12.5px; margin-top:14px; margin-bottom:5px;">Observaciones / Recomendaciones</p>
        <div class="comment-line">{{ $estudiante->observaciones_recomendaciones ?? '' }}</div>
        <div class="comment-line">&nbsp;</div>
    </div>

    <div class="footer-note">
        Documento generado digitalmente por el Sistema SIAD — Universidad de Panamá · {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>