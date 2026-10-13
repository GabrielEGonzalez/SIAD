<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - SIAD</title>

    {{-- FullCalendar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

    {{-- Fuente y estilos básicos --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    {{-- Lateral izquierdo --}}
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

            <a href="{{ route('citas.index') }}" class="{{ request()->is('citas.index') ? 'active' : '' }}">
                <i class="bi bi-calendar"></i>
                <span>Agenda de citas</span>
            </a>

            <a href="#">
                <i class="bi bi-envelope-arrow-up"></i>
                <span>Enviar reportes</span>
            </a>

        </div>
    </div>

    {{-- Panel principal --}}
    <div class="main">
        {{-- <div class="top-bar">
            <h2>Panel de Administrador</h2>
            <h2 class="user-name">Bienvenido, {{ session('nombre') }}</h2>
            <form action="{{ route('login') }}" method="GET">
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div> --}}

        <div class="top-bar">
            <h2>Panel de Administrador</h2>

            <div class="user-area">
                <span class="user-name">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon">
                        <path
                            d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.2c-3.2 0-9.8 1.6-9.8 4.9V22h19.5v-2.9c0-3.2-6.5-4.9-9.7-4.9z" />
                    </svg>
                    {{ session('nombre') }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" class="icon">
                            <path d="M15 3h4v18h-4M10 17l5-5-5-5M15 12H3" />
                        </svg>
                        Salir
                    </button>
                </form>
            </div>
        </div>

        {{-- <div class="stats">
            <div class="stat-box">20<br>N casos</div>
            <div class="stat-box">20<br>N casos <br>seguimiento</div>
            <div class="stat-box">20<br>N casos <br>cerrados</div>
        </div> --}}

    <div class="stats-container">

            <div class="stat-box">
                <i class="bi bi-people"></i>
                <h3>{{ $totalCasos }}</h3>
                <p>Casos totales</p>
            </div>

            <div class="stat-box">
                <i class="bi bi-activity"></i>
                <h3>{{ $casosEnSeguimiento }}</h3>
                <p>Casos en seguimiento</p>
            </div>

            <div class="stat-box">
                <i class="bi bi-calendar-event"></i>
                <h3>{{ $citasHoy }}</h3>
                <p>Citas hoy</p>
            </div>

        </div>
        {{-- Calendario --}}
        <div id="calendar"></div>
        <div class="quick-actions">

            <button class="q-btn">
                <i class="bi bi-file-earmark-plus"></i>
                Registrar Caso
            </button>

            <button class="q-btn">
                <i class="bi bi-calendar-week"></i>
                Citas de Hoy
            </button>

            <button class="q-btn">
                <i class="bi bi-bar-chart-line"></i>
                Generar Reporte
            </button>

        </div>
        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>
    </div>

    {{-- FullCalendar JS --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 480,
        locale: 'es',
        headerToolbar: {
            left: 'title',
            center: '',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        },

        eventColor: '#2979ff',
        eventTextColor: '#fff',

        events: "{{ route('api.citas') }}", // ← AQUÍ SE CARGA TODO
    });

    calendar.render();
});
</script>

</body>

</html>