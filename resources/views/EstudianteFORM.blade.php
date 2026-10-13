<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaración de Discapacidad - SIAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/formEST.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('img/UP-logo.png') }}" alt="Logo">
            <h1>SIAD</h1>
        </div>

        <div class="menu">

            <a href="{{ route('panel') }}" class="{{ request()->is('panel') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('reportes.casos') }}" class="{{ request()->is('reportes.casos') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i>
                <span>Casos</span>
            </a>

            <a href="{{ route('estudiante') }}" class="{{ request()->is('estudiante') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-plus"></i>
                <span>Registrar casos</span>
            </a>

            <a href="{{ route('reportes.estadisticos') }}"
                class="{{ request()->is('reportes.estadisticos') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i>
                <span>Reportes</span>
            </a>

            <a href="#">
                <i class="bi bi-calendar"></i>
                <span>Agenda de citas</span>
            </a>

            <a href="#">
                <i class="bi bi-envelope-arrow-up"></i>
                <span>Enviar reportes</span>
            </a>

        </div>
    </div>

    <!-- PANEL PRINCIPAL -->
    <div class="main">

        <div class="top-bar">
            <h2>Declaración de Discapacidad</h2>

            <div class="user-area">
                <span class="user-name">
                    <i class="bi bi-person-circle"></i> {{ session('nombre') }}
                </span>

                <form action="{{ route('login') }}" method="GET">
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Salir
                    </button>
                </form>
            </div>
        </div>

        <!-- FORMULARIO -->
        <div class="multi-container">

            <!-- INDICADORES -->
            <div class="steps-header">
                <div class="step-indicator active">
                    <div class="step-circle">1</div><small>Datos</small>
                </div>
                <div class="step-indicator">
                    <div class="step-circle">2</div><small>Académico</small>
                </div>
                <div class="step-indicator">
                    <div class="step-circle">3</div><small>Discapacidad</small>
                </div>
                <div class="step-indicator">
                    <div class="step-circle">4</div><small>Salud</small>
                </div>
                <div class="step-indicator">
                    <div class="step-circle">5</div><small>Económico</small>
                </div>
                <div class="step-indicator">
                    <div class="step-circle">6</div><small>Final</small>
                </div>
            </div>

            <form id="multiForm" method="POST" action="{{ route('discapacidad.store') }}">
                @csrf
                <!-- PASO 1: DATOS GENERALES -->
                 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="step active">
                    <h3>1. Datos Generales</h3>

                    <label>Apellido</label><input type="text" name="apellido">
                    <label>Nombre</label><input type="text" name="nombre">
                    <label>Edad</label><input type="number" name="edad">
                    <label>Cédula</label><input type="number" name="cedula">
                    <label>Dirección</label><input type="text" name="direccion_calle">
                    <label>Teléfono fijo</label><input type="text" name="telefono_fijo">
                    <label>Teléfono celular</label><input type="text" name="telefono_celular">
                    <label>Correo electrónico</label><input type="email" name="correo">


                </div>

                <!-- PASO 2: SITUACIÓN ACADÉMICA -->
                <div class="step">
                    <h3>2. Situación Académica</h3>

                    <label>Facultad</label><input type="text" name="facultad">
                    <label>Carrera</label><input type="text" name="carrera">
                    <label>Año de ingreso</label><input type="number" name="anio_ingreso">
                    <label>Año que cursa</label><input type="number" name="anio_curso">


                </div>

                <!-- PASO 3: DISCAPACIDAD -->
                <div class="step">
                    <h3>3. Discapacidad</h3>

                    <table>
                        <thead>
                            <tr>
                                <th>Sí</th>
                                <th>No</th>
                                <th>Condición</th>
                                <th>Diagnóstico</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="radio" name="dificultad[leer]" value="si"></td>
                                <td><input type="radio" name="dificultad[leer]" value="no"></td>
                                <td>Leer aun con lentes</td>
                                <td><input type="text" name="observaciones[leer]"></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="dificultad[oir]" value="si"></td>
                                <td><input type="radio" name="dificultad[oir]" value="no"></td>
                                <td>Oír aun usando audífonos</td>
                                <td><input type="text" name="observaciones[oir]"></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="dificultad[caminar]" value="si"></td>
                                <td><input type="radio" name="dificultad[caminar]" value="no"></td>
                                <td>Caminar o subir escaleras</td>
                                <td><input type="text" name="observaciones[caminar]"></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="dificultad[agarrar]" value="si"></td>
                                <td><input type="radio" name="dificultad[agarrar]" value="no"></td>
                                <td>Agarrar objetos</td>
                                <td><input type="text" name="observaciones[agarrar]"></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="dificultad[aprender]" value="si"></td>
                                <td><input type="radio" name="dificultad[aprender]" value="no"></td>
                                <td>Aprender</td>
                                <td><input type="text" name="observaciones[aprender]"></td>
                            </tr>
                            <tr>
                                <td><input type="radio" name="dificultad[otra]" value="si"></td>
                                <td><input type="radio" name="dificultad[otra]" value="no"></td>
                                <td>Otra</td>
                                <td><input type="text" name="observaciones[otra]"></td>
                            </tr>
                        </tbody>
                    </table>

                    <label>¿Tiene certificado?</label>
                    <label><input type="radio" name="certificado" value="si"> Sí</label>
                    <label><input type="radio" name="certificado" value="no"> No</label>
                    <label><input type="radio" name="certificado" value="tramite"> En trámite</label>

                </div>

                <!-- PASO 4: SALUD -->
                <div class="step">
                    <h3>4. Situación de Salud</h3>

                    <label>¿Recibe algún tipo de terapia?</label>
                    <label><input type="radio" name="terapia" value="si"> Sí</label>
                    <label><input type="radio" name="terapia" value="no"> No</label>
                    <input type="text" name="especifica_terapia" placeholder="Especifique">

                    <label>En caso de emergencia llamar a:</label>
                    <input type="text" name="telefono_emergencia" placeholder="Teléfono">
                    <input type="text" name="parentesco_emergencia" placeholder="Parentesco">

                </div>

                <!-- PASO 5: ECONÓMICO -->
                <div class="step">
                    <h3>5. Situación Económico–Laboral</h3>

                    <label>¿Trabaja?</label>
                    <label class="custom-radio"><input type="radio" name="trabaja" value="si"> Sí</label>
                    <label class="custom-radio"><input type="radio" name="trabaja" value="no"> No</label>

                    <label>Lugar</label><input type="text" name="lugar_trabajo">
                    <label>Cargo</label><input type="text" name="cargo">
                    <label>Horario</label><input type="text" name="horario">
                    <input type="text" name="institucion_beca" placeholder="Institución">

                    <label>¿Recibe subsidio o beca?</label>
                    <label class="custom-radio"><input type="radio" name="beca" value="si"> Sí</label>
                    <label class="custom-radio"><input type="radio" name="beca" value="no"> No</label>

                    <input type="text" placeholder="Institución">
                </div>

                <!-- PASO 6: FINAL -->
                <div class="step">
                    <h3>6. Comentarios y Firma</h3>

                    <label>Comentarios</label>
                    <textarea rows="4" name="comentarios"></textarea>
                    <label>Firma Digital</label>

                    <canvas id="signaturePad" width="500" height="200"
                        style="border: 2px solid #118A7E; border-radius: 10px; background:white;">
                    </canvas>

                    <br>
                    <button type="button" class="btn" onclick="clearSignature()">Limpiar Firma</button>

                    <input type="hidden" id="signatureImage" name="firma">

                    <h3 style="margin-top:30px;">Para uso del personal</h3>

                    <h3>Para uso del personal</h3>
                    <label>Tipo de discapacidad</label>
                    <label><input type="checkbox" name="tipo_discapacidad[]" value="motora"> Motora</label>
                    <label><input type="checkbox" name="tipo_discapacidad[]" value="visual"> Visual</label>
                    <label><input type="checkbox" name="tipo_discapacidad[]" value="auditiva"> Auditiva</label>
                    <label><input type="checkbox" name="tipo_discapacidad[]" value="mental"> Mental</label>
                    <label><input type="checkbox" name="tipo_discapacidad[]" value="otra"> Otra</label>

                    <label>Duración</label>
                    <label><input type="radio" name="dur" value="permanente"> Permanente</label>
                    <label><input type="radio" name="dur" value="temporal"> Temporal</label>

                    <textarea rows="3" name="observaciones_finales"></textarea>
                </div>

                <!-- BOTONES -->
                <div class="buttons">
                    <button type="button" id="prevBtn" class="btn-secondary btn" disabled>Anterior</button>
                    <button type="button" id="nextBtn" class="btn">Siguiente</button>
                </div>

            </form>
        </div>
        <!-- Mostrar errores generales -->


        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>
    </div>

    <!-- SCRIPT MULTIPASO + FIRMA DIGITAL -->
    <script>
        /* ===== MULTIPASO ===== */
        let currentStep = 0;
        const steps = document.querySelectorAll(".step");
        const indicators = document.querySelectorAll(".step-indicator");
        const nextBtn = document.getElementById("nextBtn");
        const prevBtn = document.getElementById("prevBtn");

        function showStep(n) {
            steps.forEach(s => s.classList.remove("active"));
            steps[n].classList.add("active");

            indicators.forEach(i => i.classList.remove("active"));
            indicators[n].classList.add("active");

            prevBtn.disabled = n === 0;
            nextBtn.textContent = n === steps.length - 1 ? "Enviar" : "Siguiente";
        }

        nextBtn.onclick = () => {
            // Si NO es el último paso → avanzar
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
                return;
            }

            // Si ES el último paso → enviar formulario
            document.getElementById("multiForm").submit();
        };

        prevBtn.onclick = () => {
            if (currentStep > 0) currentStep--;
            showStep(currentStep);
        };

        /* ===== FIRMA DIGITAL ===== */
        const canvas = document.getElementById("signaturePad");
        const ctx = canvas.getContext("2d");
        let drawing = false;

        canvas.addEventListener("mousedown", e => {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener("mousemove", e => {
            if (!drawing) return;
            ctx.lineWidth = 2;
            ctx.lineCap = "round";
            ctx.strokeStyle = "#000";
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        });

        canvas.addEventListener("mouseup", () => {
            drawing = false;
            saveSignature();
        });

        canvas.addEventListener("mouseleave", () => drawing = false);

        function saveSignature() {
            const data = canvas.toDataURL("image/png");
            document.getElementById("signatureImage").value = data;
        }

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            saveSignature();
        }
    </script>

</body>

</html>