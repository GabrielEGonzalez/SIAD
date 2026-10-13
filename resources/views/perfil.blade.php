<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Casos - SIAD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
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

            <a href="{{ route('reportes.casos') }}" class="{{ request()->is('reportes/casos') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i>
                <span>Casos</span>
            </a>

            <a href=" {{ route('estudiante') }}" class="{{ request()->is('estudiante') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-plus"></i>
                <span>Registrar casos</span>
            </a>

            <a href="{{ route('reportes.estadisticos') }}"
                class="{{ request()->is('reportes/estadisticos') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line"></i>
                <span>Reportes</span>
            </a>

            <a href="#">
                <i class="bi bi-calendar"></i>
                <span>Agenda de citas</span>
            </a>

        </div>
    </div>

    <div class="main">

        <div class="top-bar">
            <h2>Perfil del Estudiante</h2>

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

        <div class="profile-card">

            <h2><i class="bi bi-person-badge"></i> Perfil del Estudiante</h2>
            <h3>{{ $estudiante->persona->nombre }} {{ $estudiante->persona->apellido }}</h3>

            <div class="profile-grid">
                <div class="profile-item">
                    <label>Cédula</label>
                    <p>{{ $estudiante->idCedula }}</p>
                </div>

                <div class="profile-item">
                    <label>Correo</label>
                    <p>{{ $estudiante->correo_electronico }}</p>
                </div>

                <div class="profile-item">
                    <label>Teléfono</label>
                    <p>{{ $estudiante->telefonoContactoCelular }}</p>
                </div>
            </div>

            <div class="profile-divider"></div>

            <!-- DIRECCIÓN -->
            <div class="profile-section">
                <h4><i class="bi bi-geo-alt"></i> Dirección</h4>

                <div class="profile-grid">
                    <div class="profile-item">
                        <label>Calle</label>
                        <p>{{ $estudiante->direccion->calle ?? 'No registrado' }}</p>
                    </div>

                    <div class="profile-item">
                        <label>Provincia</label>
                        <p>{{ $estudiante->direccion->provincia ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <div class="profile-divider"></div>

            <!-- SITUACIÓN ACADÉMICA -->
            <div class="profile-section">
                <h4><i class="bi bi-mortarboard"></i> Situación Académica</h4>

                <div class="profile-grid">
                    <div class="profile-item">
                        <label>Facultad</label>
                        <p>{{ $estudiante->situacionAcademica->facultad ?? '—' }}</p>
                    </div>

                    <div class="profile-item">
                        <label>Carrera</label>
                        <p>{{ $estudiante->situacionAcademica->carrera ?? '—' }}</p>
                    </div>

                    <div class="profile-item">
                        <label>Año que cursa</label>
                        <p>{{ $estudiante->situacionAcademica->anioCursa ?? '—' }}</p>
                    </div>
                </div>
            </div>

        </div>


        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>

    </div>

</body>

</html>