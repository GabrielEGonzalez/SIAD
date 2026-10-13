<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro-SIAD</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/registra.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="cont">
        <div class="cont-1">
            <div class="cont-img">
                <img src="<?php echo e(asset('img/UP-logo.png')); ?>" alt="logo_universidad">
                <h1>SIAD</h1>
            </div>

            <form action="<?php echo e(route('registrarUser.store')); ?>" method="POST">
                <h2 class="titulo-form" aria-label="Formulario de registro de usuario">Registro de Usuario</h2>
                <?php echo csrf_field(); ?>
                <div class="contenedores-form">
                    <label for="idCedula">Cédula:</label>
                    <input type="number" name="idCedula" id="idCedula" placeholder="Ejemplo: 123456789" required
                        autocomplete="off">
                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-msg"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <div class="contenedores-form">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" required
                        autocomplete="given-name">
                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-msg"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <div class="contenedores-form">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Tu apellido" required
                        autocomplete="family-name">
                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-msg"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <div class="contenedores-form">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo" placeholder="correo@ejemplo.com" required
                        autocomplete="email">
                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-msg"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                <div class="contenedores-form">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" name="contraseña" id="contraseña" placeholder="********" required
                        autocomplete="new-password">
                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-msg"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>
                <div class="contenedores-form">
                    <button type="submit">Registrar</button>
                </div>

                <div class="mensaje-estatico">
                    ¿Ya tienes una cuenta?
                    <a href="<?php echo e(route('login')); ?>">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
        <!-- Modal de cargando -->

    </div>
    <div id="modal-registro" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>Procesando registro...</h3>
            <p>Por favor espera un momento.</p>
            <div class="loader"></div>
        </div>
    </div>
    <div id="modal-cargando" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>Procesando registro...</h3>
            <p>Por favor espera un momento.</p>
            <div class="loader"></div>
        </div>
    </div>

    <!-- Modal Éxito -->
    <div id="modal-exito" class="modal" style="display:none;">
        <div class="modal-content" style="border-left:8px solid #28a745;">
            <h3>Registro exitoso ✔</h3>
            <p>Tu cuenta ha sido creada correctamente.</p>
            <button onclick="cerrarExito()">Cerrar</button>
        </div>
    </div>

    <!-- Modal Error -->
    <div id="modal-error" class="modal" style="display:none;">
        <div class="modal-content" style="border-left:8px solid #d9534f;">
            <h3>Error</h3>
            <p id="error-texto"></p>
            <button onclick="cerrarError()">Cerrar</button>
        </div>
    </div>

    <script>
        // Mostrar modal de carga al enviar el formulario
        document.querySelector("form").addEventListener("submit", function (e) {
            document.getElementById("modal-cargando").style.display = "flex";

            // Evita doble clic
            const btn = this.querySelector("button[type='submit']");
            btn.disabled = true;
            btn.textContent = "Registrando...";
        });

        // Si Laravel devuelve un mensaje de éxito (Session::flash)
        <?php if(session('success')): ?>
            window.addEventListener("load", () => {
                document.getElementById("modal-exito").style.display = "flex";
            });
        <?php endif; ?>

        // Si Laravel devuelve error
        <?php if($errors->any()): ?>
            window.addEventListener("load", () => {
                const errores = <?php echo json_encode($errors->all(), 15, 512) ?>;
                document.getElementById("error-texto").textContent = errores[0];
                document.getElementById("modal-error").style.display = "flex";
            });
        <?php endif; ?>

            function cerrarExito() {
                document.getElementById("modal-exito").style.display = "none";
            }

        function cerrarError() {
            document.getElementById("modal-error").style.display = "none";
        }
    </script>

</body>

</html><?php /**PATH C:\xampp\htdocs\sistema_discapacidad\resources\views/Registrar.blade.php ENDPATH**/ ?>