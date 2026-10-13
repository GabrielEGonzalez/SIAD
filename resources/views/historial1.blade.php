<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Casos - SIAD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/historial.css') }}">
    
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
            <h2>Gestión de Casos</h2>

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

        <div class="form-container">

    <h2><i class="bi bi-clock-history"></i> Historial de Seguimientos</h2>
    <h4>Caso #{{ $caso->id_casos }}</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Responsable</th>
                <th>Ayuda Técnica</th>
                <th>Remitido</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($seguimientos as $seg)
                <tr>
                    <td>{{ $seg->fecha }}</td>
                    <td>{{ $seg->responsableSeguimiento }}</td>
                    <td>{{ $seg->ayudaTecnica }}</td>
                    <td>{{ ucfirst($seg->remitido) }}</td>

                    <td>
                        <a href="{{ route('seguimiento.perfil', Crypt::encryptString($seg->id_estudiante)) }}"
                            class="btn-outline-primary">
                            Ver Estudiante
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay seguimientos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>

    </div>

</body>

</html>