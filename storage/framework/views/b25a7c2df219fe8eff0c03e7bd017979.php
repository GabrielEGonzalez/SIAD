<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Casos - SIAD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/historial.css')); ?>">
    
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

                <form action="<?php echo e(route('login')); ?>" method="GET">
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Salir
                    </button>
                </form>
            </div>
        </div>

        <div class="form-container">

    <h2><i class="bi bi-clock-history"></i> Historial de Seguimientos</h2>
    <h4>Caso #<?php echo e($caso->id_casos); ?></h4>

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
            <?php $__empty_1 = true; $__currentLoopData = $seguimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($seg->fecha); ?></td>
                    <td><?php echo e($seg->responsableSeguimiento); ?></td>
                    <td><?php echo e($seg->ayudaTecnica); ?></td>
                    <td><?php echo e(ucfirst($seg->remitido)); ?></td>

                    <td>
                        <a href="<?php echo e(route('seguimiento.perfil', Crypt::encryptString($seg->id_estudiante))); ?>"
                            class="btn-outline-primary">
                            Ver Estudiante
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center">No hay seguimientos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>

    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\sistema_discapacidad\resources\views/historial.blade.php ENDPATH**/ ?>