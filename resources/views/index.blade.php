<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Citas - SIAD</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        :root{
            --primary:#118A7E;
            --muted:#77828a;
            --card-bg: #ffffff;
        }

        body{
            font-family: 'Poppins', sans-serif;
            margin:0;
            display:flex;
            background:#f4f6f9;
        }

        /* Layout principal */
        .container {
            flex:1;
            padding:28px;
        }

        .grid {
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 22px;
            align-items:start;
        }

        /* Formulario */
        .card {
            background:var(--card-bg);
            padding:18px;
            border-radius:12px;
            box-shadow:0 6px 18px rgba(0,0,0,0.06);
        }
        .card h3{ margin:0 0 12px; color:var(--primary); }
        .form-row{ margin-bottom:10px; }
        label{ display:block; font-size:13px; color:#333; margin-bottom:6px; }
        input[type="text"], input[type="datetime-local"], textarea, select{
            width:100%; padding:10px; border-radius:8px; border:1px solid #e0e0e0; font-size:14px;
        }
        .btn-primary{
            background:var(--primary); color:#fff; padding:10px 14px; border-radius:8px; border:none; cursor:pointer; font-weight:600;
        }

        /* Tarjetas resumen */
        .summary {
            display:flex;
            gap:12px;
            margin-bottom:12px;
        }
        .summary .box{
            background:var(--card-bg);
            padding:14px;
            border-radius:10px;
            flex:1;
            text-align:center;
            box-shadow:0 4px 14px rgba(0,0,0,0.06);
        }
        .box h4{ margin:0; font-size:22px; color:#183153; }
        .box p{ margin:6px 0 0; color:var(--muted); font-size:13px; }

        /* Calendar area */
        .right-col{
            display:flex;
            flex-direction:column;
            gap:14px;
        }

        .calendar-card{ min-height:420px; }

        /* Lista de próximas citas */
        .upcoming{
            display:grid;
            grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
            gap:12px;
        }
        .upcoming .item{
            background:var(--card-bg);
            padding:12px;
            border-radius:10px;
            box-shadow:0 4px 14px rgba(0,0,0,0.05);
        }
        .badge {
            display:inline-block; padding:6px 12px; border-radius:8px; font-size:12px; color:#fff;
        }
        .badge.pendiente{ background:#f0ad4e; }
        .badge.completada{ background:#4caf50; }
        .badge.cancelada{ background:#e74c3c; }

        /* prioridad */
        .p-alta{ background:#d32f2f; color:#fff; padding:6px 8px; border-radius:8px; font-weight:600; }
        .p-media{ background:#f9a825; color:#fff; padding:6px 8px; border-radius:8px; font-weight:600; }
        .p-baja{ background:#6c757d; color:#fff; padding:6px 8px; border-radius:8px; font-weight:600; }

        @media (max-width: 980px){
            .grid{ grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo-container">
            <img src="{{ asset('img/UP-logo.png') }}" alt="Logo Universidad">
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

            <a href="{{ route('citas.index') }}" class="{{ request()->is('citas') ? 'active' : '' }}">
                <i class="bi bi-calendar"></i>
                <span>Agenda de citas</span>
            </a>

            <a href="#">
                <i class="bi bi-envelope-arrow-up"></i>
                <span>Enviar reportes</span>
            </a>

        </div>
    </div>


    <div class="container">
        <div class="top-bar">

            <h2>Citas & Agenda</h2>
            <div class="user-area">
                <span class="user-name">
                    <i class="bi bi-person-circle"></i> {{ session('nombre') }}
                </span>

                <form action="{{ route('login') }}" method="GET">
                    <button type="submit" class="logout-btn">
                        <i class=" bi bi-box-arrow-right"></i> Salir
                    </button>
                </form>
            </div>
        </div>

        <div class="summary">
            <div class="box">
                <h4 id="totalCount">{{ $total ?? 0 }}</h4>
                <p>Total de citas</p>
            </div>
            <div class="box">
                <h4 id="pendientesCount">{{ $pendientes ?? 0 }}</h4>
                <p>Pendientes</p>
            </div>
            <div class="box">
                <h4 id="completadasCount">{{ $completadas ?? 0 }}</h4>
                <p>Completadas</p>
            </div>
            <div class="box">
                <h4 id="canceladasCount">{{ $canceladas ?? 0 }}</h4>
                <p>Canceladas</p>
            </div>
        </div>

        <div class="grid">
            <!-- IZQUIERDA: FORM + tarjetas prioridad/estado -->
            <div>
                <div class="card">
                    <h3>Nueva cita / nota</h3>

                    <form id="formCita">
                        @csrf
                        <div class="form-row">
                            <label for="titulo">Título</label>
                            <input type="text" id="titulo" name="titulo" required>
                        </div>

                        <div class="form-row">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>

                        <div class="form-row">
                            <label for="fecha_hora">Fecha y hora</label>
                            <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>
                        </div>

                        <div class="form-row">
                            <label for="tipo">Tipo</label>
                            <select id="tipo" name="tipo">
                                <option value="cita">Cita</option>
                                <option value="nota">Nota</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="prioridad">Prioridad</label>
                            <select id="prioridad" name="prioridad">
                                <option value="media" selected>Media</option>
                                <option value="alta">Alta</option>
                                <option value="baja">Baja</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado">
                                <option value="pendiente" selected>Pendiente</option>
                                <option value="completada">Completada</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </div>

                        <!-- Opcionales: idPersona, idUsuario, idCaso -->
                        <div class="form-row">
                            <label for="idPersona">ID Persona (opcional)</label>
                            <input type="text" id="idPersona" name="idPersona" placeholder="id_persona" disabled>
                        </div>

                        <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:12px">
                            <button type="submit" class="btn-primary">Crear cita</button>
                        </div>
                    </form>
                </div>

                <div style="height:12px"></div>

                <div class="card">
                    <h3>Resumen por prioridad</h3>
                    <div style="display:flex;gap:8px;margin-top:10px">
                        <div style="flex:1;text-align:center">
                            <div class="p-alta" id="p_alta">0</div>
                            <small>Alta</small>
                        </div>
                        <div style="flex:1;text-align:center">
                            <div class="p-media" id="p_media">0</div>
                            <small>Media</small>
                        </div>
                        <div style="flex:1;text-align:center">
                            <div class="p-baja" id="p_baja">0</div>
                            <small>Baja</small>
                        </div>
                    </div>

                    <hr style="margin:14px 0">

                    <h3>Resumen por estado</h3>
                    <div style="display:flex;gap:8px;margin-top:10px">
                        <div style="flex:1;text-align:center">
                            <div class="badge pendiente" id="s_pendiente">0</div>
                            <small>Pendiente</small>
                        </div>
                        <div style="flex:1;text-align:center">
                            <div class="badge completada" id="s_completada">0</div>
                            <small>Completada</small>
                        </div>
                        <div style="flex:1;text-align:center">
                            <div class="badge cancelada" id="s_cancelada">0</div>
                            <small>Cancelada</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DERECHA: CALENDARIO + próximas -->
            <div class="right-col">
                <div class="card calendar-card">
                    <div id="calendar"></div>
                </div>

                <div class="card">
                    <h3>Próximas citas</h3>
                    <div id="upcoming" class="upcoming" style="margin-top:10px"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '{{ csrf_token() }}';

        // Inicializar FullCalendar
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 520,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: {
                    url: '{{ route("citas.events") }}',
                    method: 'GET',
                },
                eventClick: function(info) {
                    const ev = info.event;
                    const props = ev.extendedProps;
                    const content = `<strong>${ev.title}</strong><br>
                                     ${props.descripcion ? props.descripcion + '<br>' : ''}
                                     <small>Tipo: ${props.tipo} • Prioridad: ${props.prioridad} • Estado: ${props.estado}</small>`;
                    alert(content);
                },
                eventDidMount: function(arg) {
                    // opcional: estilo por prioridad
                    const pr = arg.event.extendedProps.prioridad;
                    if (pr === 'alta') arg.el.style.borderLeft = '6px solid #d32f2f';
                    if (pr === 'media') arg.el.style.borderLeft = '6px solid #f9a825';
                    if (pr === 'baja') arg.el.style.borderLeft = '6px solid #6c757d';
                }
            });

            calendar.render();

            // Cargar resumen y próximas citas
            loadSummary();
            loadUpcoming();
        });

        // Crear cita con fetch
        document.getElementById('formCita').addEventListener('submit', async function(e){
            e.preventDefault();

            const form = e.target;
            const data = {
                titulo: form.titulo.value,
                descripcion: form.descripcion.value,
                fecha_hora: form.fecha_hora.value,
                tipo: form.tipo.value,
                prioridad: form.prioridad.value,
                estado: form.estado.value,
                idPersona: form.idPersona.value || null,
            };

            try {
                const res = await fetch('{{ route("citas.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const json = await res.json();

                if (res.ok) {
                    alert('Cita creada correctamente');
                    // refrescar calendario y tarjetas
                    location.reload(); // simple y efectivo
                } else {
                    alert('Error: ' + (json.message || 'Verifica los datos'));
                }
            } catch (err) {
                console.error(err);
                alert('Error al crear la cita');
            }
        });

        // Cargar resumen (summary endpoint)
        async function loadSummary(){
            try {
                const res = await fetch('{{ route("citas.summary") }}');
                const json = await res.json();

                document.getElementById('p_alta').textContent = json.prioridades.alta ?? 0;
                document.getElementById('p_media').textContent = json.prioridades.media ?? 0;
                document.getElementById('p_baja').textContent = json.prioridades.baja ?? 0;

                document.getElementById('s_pendiente').textContent = json.estados.pendiente ?? 0;
                document.getElementById('s_completada').textContent = json.estados.completada ?? 0;
                document.getElementById('s_cancelada').textContent = json.estados.cancelada ?? 0;

                document.getElementById('totalCount').textContent = json.total ?? 0;
            } catch (err) {
                console.error(err);
            }
        }

        // Cargar próximas citas (ej. próximas 6 ordenadas por fecha)
        async function loadUpcoming(){
            try {
                const res = await fetch('{{ route("citas.events") }}'); // reutilizamos endpoint
                const events = await res.json();
                // ordenar por start y filtrar próximas
                events.sort((a,b) => new Date(a.start) - new Date(b.start));
                const next = events.slice(0, 6);

                const container = document.getElementById('upcoming');
                container.innerHTML = '';

                next.forEach(ev => {
                    const props = ev.extendedProps || {};
                    const item = document.createElement('div');
                    item.className = 'item';
                    const date = new Date(ev.start);
                    const dateStr = date.toLocaleString('es-PA', { dateStyle: 'medium', timeStyle: 'short' });

                    const estadoClass = (props.estado === 'pendiente') ? 'pendiente' : (props.estado === 'completada' ? 'completada' : 'cancelada');
                    const prioridadClass = (props.prioridad === 'alta') ? 'p-alta' : (props.prioridad === 'media' ? 'p-media' : 'p-baja');

                    item.innerHTML = `
                        <div style="display:flex;justify-content:space-between;align-items:center;gap:8px">
                            <div>
                                <strong>${ev.title}</strong><br>
                                <small style="color:#666">${dateStr}</small>
                            </div>
                            <div style="text-align:right">
                                <div class="${prioridadClass}" style="margin-bottom:6px">${props.prioridad}</div>
                                <div class="badge ${estadoClass}">${props.estado}</div>
                            </div>
                        </div>
                        <div style="margin-top:8px;color:#444;font-size:13px">${props.descripcion ? props.descripcion.substring(0,120) : ''}</div>
                    `;
                    container.appendChild(item);
                });

            } catch (err) {
                console.error(err);
            }
        }
    </script>
</body>
</html>
