<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - SIAD</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        /* ================= GENERAL ================= */
        body {
            background: #f4f6f9;
            font-family: 'Poppins', sans-serif;
            display: flex;
        }

        /* ================= MAIN ================= */
        .main {
            flex: 1;
            padding: 30px;
        }

        /* ================= TOP BAR ================= */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 16px 22px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        .top-bar h2 {
            font-size: 22px;
            color: #183153;
            font-weight: 600;
        }

        /* ================= USER ================= */
        .user-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .user-name {
            padding: 7px 16px;
            background: #eef3f7;
            border-radius: 8px;
            border: 1px solid #dce2e6;
            color: #183153;
            font-weight: 600;
        }

        .logout-btn {
            background: #183153;
            color: white;
            padding: 7px 14px;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: #0f223b;
        }

        /* ================= PDF BUTTON ================= */
        .top-actions {
            text-align: right;
        }

        .export-btn {
            background: #d62828;
            padding: 12px 20px;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: background .25s ease, transform .2s ease;
        }

        .export-btn:hover {
            background: #b71d1d;
            transform: translateY(-2px);
        }

        /* ================= CARDS ================= */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .card-stat {
            background: white;
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            transition: transform .2s ease;
        }

        .card-stat:hover {
            transform: translateY(-3px);
        }

        .card-stat h3 {
            font-size: 36px;
            color: #118A7E;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .card-stat span {
            font-size: 15px;
            color: #555;
        }

        /* ================= CHART ================= */
        .chart-box {
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
            margin-top: 10px;
        }

        .chart-box h3 {
            font-size: 20px;
            color: #183153;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* ================= FOOTER ================= */
        footer {
            text-align: center;
            margin-top: 25px;
            color: #777;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR (NO SE MODIFICA) -->
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

            <a href="{{ route('reportes.casos') }}" class="{{ request()->is('reportes/casos') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i>
                <span>Casos</span>
            </a>

            <a href="{{ route('estudiante') }}" class="{{ request()->is('estudiante') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-plus"></i>
                <span>Registrar casos</span>
            </a>

            <a href="{{ route('reportes.estadisticos') }}"
                class="{{ request()->is('reportes/estadisticos') ? 'active' : '' }}">
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

    <!-- MAIN -->
    <div class="main">
        <div class="top-bar">

            <h2>Estadísticas Generales</h2>
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

        <div class="estadisticas-container">

            <!-- Botón PDF -->
            <div class="top-actions">
                <a href="{{ route('reportes.pdf.general') }}" target="_blank" class="export-btn">
                    <i class="bi bi-file-earmark-pdf"></i> Exportar PDF
                </a>
            </div>

            <!-- CARDS -->
            <div class="cards">

                <div class="card-stat">
                    <h3>{{ $totalCasos }}</h3>
                    <span>Total de Casos Registrados</span>
                </div>

                <div class="card-stat">
                    <h3>{{ $casosEstudiantes }}</h3>
                    <span>Casos de Estudiantes</span>
                </div>

                <div class="card-stat">
                    <h3>{{ $casosFuncionarios }}</h3>
                    <span>Casos de Funcionarios</span>
                </div>

            </div>

            <!-- GRAFICA -->
            <div class="chart-box">
                <h3>Casos por Mes</h3>
                <canvas id="chartMeses"></canvas>
            </div>

        </div>

        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === Casos por mes ===
        new Chart(document.getElementById('chartMeses'), {
            type: 'bar',
            data: {
                labels: @json($labelsMeses),
                datasets: [{
                    label: 'Casos Registrados',
                    data: @json($dataMeses),
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: "rgba(0,0,0,0.08)" }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });

    </script>

</body>

</html>