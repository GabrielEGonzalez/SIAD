<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Casos - SIAD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <style>
        .seguimiento-card {
            background: #ffffff10;
            backdrop-filter: blur(12px);
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 8px 25px #00000030;
            margin-top: 20px;
            color: #fff;
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .seguimiento-form {
            width: 100%;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-full {
            grid-column: span 2;
        }

        .form-group label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
            color: #686868ff;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #ffffff40;
            background: #1e1e1e;
            color: #fff;
            font-size: 15px;
            transition: .25s;
        }

        .form-input:focus {
            border-color: #4ea8ff;
            box-shadow: 0 0 6px #4ea8ff70;
            outline: none;
        }

        .textarea {
            height: 120px;
            resize: vertical;
        }

        .btn-save {
            margin-top: 25px;
            width: 100%;
            border: none;
            background: #4ea8ff;
            color: #fff;
            padding: 14px;
            font-size: 17px;
            border-radius: 10px;
            cursor: pointer;
            transition: .2s;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            background: #78c0ff;
        }
    </style>
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

        <form action="<?php echo e(route('seguimiento.store')); ?>" method="POST" class="seguimiento-form">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="id_caso" value="<?php echo e($caso->id_casos); ?>">
            <input type="hidden" name="id_estudiante" value="<?php echo e($estudiante->idCedula); ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Ayuda Técnica:</label>
                    <input type="text" name="ayudaTecnica" class="form-input">
                </div>

                <div class="form-group">
                    <label>Remitido por:</label>
                    <input type="text" name="remitido_por" class="form-input">
                </div>

                <div class="form-group form-full">
                    <label>Perfil del usuario:</label>

                    <select name="perfil_usuario" class="form-input">
                        <option value="">Seleccione…</option>
                        <option value="Estudiante">Estudiante</option>
                        <option value="Docente">Docente</option>
                        <option value="Administrativo">Administrativo</option>
                        <option value="Sociedad Civil">Sociedad Civil</option>
                    </select>
                </div>

                <div class="form-group form-full">
                    <label>Motivo de solicitud de servicios:</label>
                    <textarea name="motivo_ss" class="form-input textarea"></textarea>
                </div>

                <div class="form-group form-full">
                    <label>Acciones realizadas / sugeridas:</label>
                    <textarea name="accionesRealizadas" class="form-input textarea"></textarea>
                </div>

                <div class="form-group form-full">
                    <label>Observaciones:</label>
                    <textarea name="observaciones" class="form-input textarea"></textarea>
                </div>

            </div>

            <button class="btn-save">
                <i class="bi bi-check-circle"></i> Guardar Seguimiento
            </button>

        </form>
        <footer>
            © 2025 Universidad de Panamá. Todos los derechos reservados.
        </footer>
    </div>


</body>

</html><?php /**PATH C:\xampp\htdocs\sistema_discapacidad\resources\views/create.blade.php ENDPATH**/ ?>