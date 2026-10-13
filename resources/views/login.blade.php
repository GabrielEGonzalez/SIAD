<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login-SIAD</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="cont">
        <div class="cont-1">
            <div class="cont-img">
                <div>
                    <img src="{{ asset('img/UP-logo.png') }}" alt="logo_universidad">
                </div>
                <div>
                    <h1>SIAD</h1>
                </div>
            </div>

            {{-- Modal de advertencia si Laravel envía un error --}}
            @if ($errors->any())
            <div id="modalError" class="modal">
                <div class="modal-content">
                    <h3>Error</h3>
                    <p>{{ $errors->first() }}</p>
                    <button id="closeModal">Cerrar</button>
                </div>
            </div>
            @endif

            <form id="loginForm" action="{{ route('loginUser.login') }}" method="POST">
                @csrf

                <div class="contenedores-form">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="correo" id="email" placeholder="correo@ejemplo.com">
                    <small class="error-msg" id="emailError"></small>
                </div>

                <div class="contenedores-form">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="********">
                    <small class="error-msg" id="passwordError"></small>
                </div>

                <div class="contenedores-form">
                    <button type="submit">Enviar</button>
                </div>

                <div style="margin-top:10px; text-align:center;">
                    <p style="font-size:14px; color:#444;">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" style="color:#1a73e8; font-weight:500;">Regístrate aquí</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT DE VALIDACIÓN --}}
    <script>
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const form = document.getElementById("loginForm");

        const emailError = document.getElementById("emailError");
        const passError = document.getElementById("passwordError");

        // Validación en vivo
        email.addEventListener("input", () => {
            if (email.value.trim().length === 0) {
                emailError.textContent = "El correo es obligatorio.";
            } else if (!email.value.includes("@")) {
                emailError.textContent = "Debe ser un correo válido.";
            } else {
                emailError.textContent = "";
            }
        });

        password.addEventListener("input", () => {
            if (password.value.trim().length === 0) {
                passError.textContent = "La contraseña es obligatoria.";
            } else if (password.value.length < 4) {
                passError.textContent = "La contraseña es muy corta.";
            } else {
                passError.textContent = "";
            }
        });

        // Validación antes de enviar el formulario
        form.addEventListener("submit", (e) => {
            let errors = 0;

            if (email.value.trim() === "") {
                emailError.textContent = "El correo es obligatorio.";
                errors++;
            }

            if (password.value.trim() === "") {
                passError.textContent = "La contraseña es obligatoria.";
                errors++;
            }

            if (errors > 0) {
                e.preventDefault();
            }
        });

        // Modal
        const modal = document.getElementById("modalError");
        const closeModal = document.getElementById("closeModal");

        if (closeModal) {
            closeModal.onclick = () => {
                modal.style.display = "none";
            };
        }
    </script>

</body>

</html>
