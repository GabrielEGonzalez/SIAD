<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Casos - SIAD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/casos.css')); ?>">
</head>

<body>

    <div class="sidebar">
        <div class="logo-container">
            <img src="<?php echo e(asset('img/UP-logo.png')); ?>" alt="Logo Universidad">
            <h1>SIAD</h1>
        </div>

        <div class="menu">

            <a href="<?php echo e(route('panel')); ?>" class="<?php echo e(request()->is('panel') ? 'active' : ''); ?>">
                <i class="bi bi-grid-3x3-gap-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?php echo e(route('reportes.casos')); ?>" class="<?php echo e(request()->is('reportes/casos') ? 'active' : ''); ?>">
                <i class="bi bi-person-plus"></i>
    <span>Casos</span>
</a>

<a href=" <?php echo e(route('estudiante')); ?>" class="<?php echo e(request()->is('estudiante') ? 'active' : ''); ?>">
                    <i class="bi bi-file-earmark-plus"></i>
                    <span>Registrar casos</span>
            </a>

            <a href="<?php echo e(route('reportes.estadisticos')); ?>"
                class="<?php echo e(request()->is('reportes/estadisticos') ? 'active' : ''); ?>">
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
                    <i class="bi bi-person-circle"></i> <?php echo e(session('nombre')); ?>

                </span>

                <form action="<?php echo e(route('logout')); ?>" method="GET">
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Salir
                    </button>
                </form>
            </div>
        </div>

        <div class="content">

            <h2 class="section-title">
                <i class="bi bi-person-lines-fill"></i> Lista de Casos
            </h2>

            <div class="filters">
                <input type="text" placeholder="Buscar por nombre o ID..." disabled>
                <select disabled>
                    <option value="">Tipo de persona</option>
                    <option value="Estudiante">Estudiante</option>
                    <option value="Funcionario">Funcionario</option>
                </select>

                <button class="btn-filter" disabled>
                    <i class="bi bi-filter-circle"></i> Filtrar
                </button>
            </div>

            <div class="table-container">
                <table class="cases-table">
                    <thead>
                        <tr>
                            <th>ID Caso</th>
                                <th>Persona</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $casosV; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>#<?php echo e($caso->id_casos); ?></td>

                                <td>
                                    <?php echo e($caso->personas->first()->persona->nombre ?? '—'); ?>

                                    <?php echo e($caso->personas->first()->persona->apellido ?? ''); ?>

                                </td>

                                <td>
                                    <?php echo e(ucfirst($caso->personas->first()->persona->tipo ?? 'N/A')); ?>

                                </td>

                                <td>
                                    <?php echo e(\Carbon\Carbon::parse($caso->fechaRegistro)->format('Y-m-d')); ?>

                                </td>

                                <td>
                                    
<a href="<?php echo e(route('seguimiento.create', $caso->id_casos)); ?>" class="action-btn edit">
    <i class="bi bi-journal-plus"></i>
</a>


<a href="<?php echo e(route('seguimiento.historial', $caso->id_casos)); ?>" class="action-btn view">
    <i class="bi bi-clock-history"></i>
</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" style="text-align:center;">No hay casos registrados</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>

        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>

    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\sistema_discapacidad\resources\views/casos.blade.php ENDPATH**/ ?>