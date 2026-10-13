<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIAD · Orientación y Bienestar</title>
    <!-- Fuentes e íconos -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Inter:wght@400;500;600;700&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <style>
        /* Reset y variables */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: #eef3ee;
            font-family: 'Inter', sans-serif;
            color: #1d2b24;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1rem;
        }
        .container {
            max-width: 1200px;
            width: 100%;
            background: transparent;
            padding: 0 0 1.5rem;
        }

        /* Navegación */
        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 0.8rem 1.2rem;
            padding: 0.5rem 0;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Lora', serif;
            font-weight: 600;
            font-size: 1.4rem;
            color: #1f4038;
        }
        .brand svg {
            width: 36px;
            height: 36px;
        }
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .btn {
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: 0.15s;
            text-decoration: none;
            color: #1d2b24;
            border: 1.5px solid #dde6dd;
        }
        .btn-solid {
            background: #2f5d50;
            color: white;
            border-color: #2f5d50;
        }
        .btn-solid:hover {
            background: #1f4038;
        }
        .btn-ghost:hover {
            background: #f0f5f0;
        }
        .btn i {
            font-size: 1rem;
        }

        /* SVG - sin marco, sobre fondo plano */
        .svg-container {
            width: 100%;
            margin: 1rem 0 2rem;
            display: flex;
            justify-content: center;
        }
        .svg-container svg {
            width: 100%;
            height: auto;
            max-width: 1100px;
            display: block;
            border-radius: 0;
            background: transparent;
        }

        /* Texto y botón de login */
        .descripcion {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem 2rem;
            padding: 0.5rem 0 0.2rem;
            border-top: 1px solid #dde6dd;
            padding-top: 1.8rem;
            margin-top: 0.5rem;
        }
        .descripcion h2 {
            font-family: 'Lora', serif;
            font-weight: 600;
            font-size: 1.5rem;
            color: #1f4038;
        }
        .descripcion h2 em {
            color: #c98a3e;
            font-style: normal;
        }
        .descripcion p {
            color: #4a5a50;
            max-width: 400px;
            font-size: 0.95rem;
        }
        .login-boton {
            background: #c98a3e;
            color: white;
            border: none;
            padding: 0.7rem 1.8rem;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 8px rgba(201, 138, 62, 0.2);
            transition: 0.15s;
            cursor: pointer;
            text-decoration: none;
        }
        .login-boton:hover {
            background: #b0742f;
            transform: scale(1.02);
        }

        /* Footer */
        .footer {
            margin-top: 2.5rem;
            font-size: 0.75rem;
            color: #8a998f;
            text-align: center;
            border-top: 1px solid #dde6dd;
            padding-top: 1.5rem;
        }
        .badge {
            background: #fbf1e1;
            color: #c98a3e;
            font-family: 'DM Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            padding: 0.2rem 0.8rem;
            border-radius: 30px;
        }

        /* Responsive */
        @media (max-width: 700px) {
            .container {
                padding: 0;
            }
            .descripcion {
                flex-direction: column;
                align-items: flex-start;
            }
            .descripcion p {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Navegación -->
        <div class="nav">
            <div class="brand">
                <!-- Logo pequeño en SVG -->
                <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="18" fill="#2f5d50" />
                    <path d="M12 26L18 14L24 26L20 20L16 26L12 26Z" fill="white" opacity="0.9" />
                    <circle cx="20" cy="14" r="3" fill="#c98a3e" />
                </svg>
                <span>SIAD</span>
            </div>
            <div class="actions">
                <a href="#" class="btn btn-ghost"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</a>
                <a href="#" class="btn btn-solid"><i class="bi bi-person-plus"></i> Solicitar orientación</a>
            </div>
        </div>

        <!-- SVG CENTRAL: Estilo Open Peeps, plano y profesional -->
        <div class="svg-container">
            <svg viewBox="0 0 1100 500" xmlns="http://www.w3.org/2000/svg" version="1.1">
                <defs>
                    <!-- Sombras y estilos planos -->
                    <filter id="sombraPeep" x="-5%" y="-5%" width="115%" height="115%">
                        <feDropShadow dx="0" dy="3" stdDeviation="4" flood-color="#1f4038" flood-opacity="0.1" />
                    </filter>
                </defs>

                <!-- Fondo de la escena (plano, sin marco) -->
                <rect width="1100" height="500" fill="#eef3ee" rx="0" ry="0" />

                <!-- Elementos de fondo (muy sutiles) -->
                <rect x="820" y="40" width="180" height="120" rx="12" fill="#dce9e0" opacity="0.5" />
                <rect x="830" y="50" width="160" height="100" rx="8" fill="#e3f0e6" opacity="0.4" />
                <line x1="910" y1="50" x2="910" y2="150" stroke="#bccfc0" stroke-width="2" opacity="0.3" />
                <line x1="830" y1="100" x2="990" y2="100" stroke="#bccfc0" stroke-width="2" opacity="0.3" />
                <rect x="850" y="60" width="20" height="20" rx="4" fill="#c9dccd" opacity="0.5" />
                <rect x="890" y="60" width="20" height="20" rx="4" fill="#c9dccd" opacity="0.5" />

                <!-- Escritorio (plano) -->
                <rect x="60" y="340" width="240" height="60" rx="6" fill="#d6e0d6" stroke="#bccfc0" stroke-width="1.5" />
                <rect x="70" y="350" width="220" height="40" rx="4" fill="#eaf0ea" stroke="#c5d4c5" stroke-width="1" />
                <!-- Computadora -->
                <rect x="130" y="310" width="70" height="30" rx="4" fill="#d0dcd0" stroke="#a0b8a0" stroke-width="1" />
                <rect x="140" y="316" width="50" height="18" rx="2" fill="#f0f7f0" />
                <rect x="162" y="340" width="6" height="10" fill="#b0c4b0" />

                <!-- ============================================================ -->
                <!--  PERSONAJE 1: PERSONA CON DISCAPACIDAD (estilo Open Peeps)     -->
                <g transform="translate(380, 200)" filter="url(#sombraPeep)">
                    <!-- Silla de ruedas (estilo plano) -->
                    <circle cx="50" cy="90" r="26" fill="none" stroke="#4a5a50" stroke-width="6" />
                    <circle cx="50" cy="90" r="14" fill="#3d4d43" />
                    <circle cx="120" cy="90" r="26" fill="none" stroke="#4a5a50" stroke-width="6" />
                    <circle cx="120" cy="90" r="14" fill="#3d4d43" />
                    <line x1="50" y1="90" x2="120" y2="90" stroke="#4a5a50" stroke-width="6" />
                    <line x1="75" y1="65" x2="75" y2="40" stroke="#4a5a50" stroke-width="6" />
                    <line x1="55" y1="40" x2="95" y2="40" stroke="#4a5a50" stroke-width="6" />
                    <line x1="75" y1="40" x2="75" y2="15" stroke="#4a5a50" stroke-width="6" />
                    <line x1="50" y1="90" x2="25" y2="40" stroke="#4a5a50" stroke-width="6" />
                    <line x1="25" y1="40" x2="55" y2="40" stroke="#4a5a50" stroke-width="6" />

                    <!-- Cuerpo (estilo Open Peeps) -->
                    <circle cx="75" cy="12" r="18" fill="#f5d6b8" stroke="#dbb89a" stroke-width="2" />
                    <rect x="55" y="28" width="40" height="34" rx="6" fill="#3b6b5e" stroke="#2f5d50" stroke-width="2" />
                    <!-- Brazos -->
                    <line x1="55" y1="36" x2="35" y2="54" stroke="#f5d6b8" stroke-width="8" stroke-linecap="round" />
                    <line x1="95" y1="36" x2="115" y2="54" stroke="#f5d6b8" stroke-width="8" stroke-linecap="round" />
                    <!-- Cabello (estilo peep) -->
                    <path d="M60 2 Q75 -12 90 2 Q95 10 85 12 Q75 6 65 12 Q55 10 60 2" fill="#4d2e1a" />
                    <!-- Ojos y sonrisa -->
                    <circle cx="68" cy="10" r="3" fill="#1d2b24" />
                    <circle cx="82" cy="10" r="3" fill="#1d2b24" />
                    <path d="M68 20 Q75 26 82 20" stroke="#1d2b24" stroke-width="2" fill="none" stroke-linecap="round" />
                </g>

                <!-- ============================================================ -->
                <!--  PERSONAJE 2: ENFERMERA (estilo Open Peeps)                    -->
                <g transform="translate(180, 210)" filter="url(#sombraPeep)">
                    <!-- Cuerpo -->
                    <rect x="25" y="35" width="50" height="80" rx="8" fill="white" stroke="#b0c8b8" stroke-width="2" />
                    <!-- Delantal / cruz -->
                    <rect x="35" y="48" width="30" height="20" rx="4" fill="#e8f0ee" stroke="#b0c8b8" stroke-width="1.5" />
                    <circle cx="50" cy="58" r="7" fill="#b5544a" />
                    <!-- Cabeza -->
                    <circle cx="50" cy="18" r="18" fill="#f5d6b8" stroke="#dbb89a" stroke-width="2" />
                    <!-- Gorro de enfermera -->
                    <path d="M36 6 L50 -8 L64 6 L58 12 L50 6 L42 12 L36 6" fill="white" stroke="#b0c8b8" stroke-width="2" />
                    <rect x="38" y="-2" width="24" height="10" rx="3" fill="white" stroke="#b0c8b8" stroke-width="1.5" />
                    <!-- Ojos y sonrisa -->
                    <circle cx="42" cy="16" r="3" fill="#1d2b24" />
                    <circle cx="58" cy="16" r="3" fill="#1d2b24" />
                    <path d="M42 26 Q50 32 58 26" stroke="#1d2b24" stroke-width="2" fill="none" stroke-linecap="round" />
                    <!-- Brazos -->
                    <line x1="25" y1="52" x2="0" y2="68" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <line x1="75" y1="52" x2="100" y2="68" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <!-- Piernas -->
                    <line x1="38" y1="115" x2="28" y2="148" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <line x1="62" y1="115" x2="72" y2="148" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <!-- Zapatos -->
                    <rect x="16" y="144" width="24" height="10" rx="5" fill="white" stroke="#b0c8b8" stroke-width="1.5" />
                    <rect x="60" y="144" width="24" height="10" rx="5" fill="white" stroke="#b0c8b8" stroke-width="1.5" />
                </g>

                <!-- ============================================================ -->
                <!--  PERSONAJE 3: LICENCIADA (estilo Open Peeps)                   -->
                <g transform="translate(680, 210)" filter="url(#sombraPeep)">
                    <!-- Cuerpo (traje) -->
                    <rect x="25" y="35" width="50" height="80" rx="8" fill="#3d5a73" stroke="#2f4d5a" stroke-width="2" />
                    <!-- Solapa -->
                    <path d="M38 35 L28 58 L38 52 L48 58 L38 35" fill="#4d6e7a" stroke="#2f4d5a" stroke-width="1.5" />
                    <!-- Cabeza -->
                    <circle cx="50" cy="18" r="18" fill="#f5d6b8" stroke="#dbb89a" stroke-width="2" />
                    <!-- Cabello recogido -->
                    <path d="M34 10 Q50 -8 66 10 Q72 18 62 22 Q50 16 38 22 Q28 18 34 10" fill="#3d2b1a" />
                    <circle cx="50" cy="6" r="6" fill="#3d2b1a" />
                    <!-- Gafas -->
                    <circle cx="40" cy="16" r="7" fill="none" stroke="#1f4038" stroke-width="2" />
                    <circle cx="60" cy="16" r="7" fill="none" stroke="#1f4038" stroke-width="2" />
                    <line x1="47" y1="16" x2="53" y2="16" stroke="#1f4038" stroke-width="2" />
                    <!-- Ojos y sonrisa -->
                    <circle cx="40" cy="16" r="2.5" fill="#1d2b24" />
                    <circle cx="60" cy="16" r="2.5" fill="#1d2b24" />
                    <path d="M42 26 Q50 32 58 26" stroke="#1d2b24" stroke-width="2" fill="none" stroke-linecap="round" />
                    <!-- Brazos -->
                    <line x1="25" y1="52" x2="0" y2="68" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <line x1="75" y1="52" x2="100" y2="68" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <!-- Piernas / falda -->
                    <rect x="28" y="115" width="44" height="30" rx="4" fill="#3d5a73" stroke="#2f4d5a" stroke-width="2" />
                    <line x1="36" y1="145" x2="28" y2="160" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <line x1="64" y1="145" x2="72" y2="160" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <rect x="16" y="156" width="22" height="10" rx="5" fill="#2f4d5a" />
                    <rect x="62" y="156" width="22" height="10" rx="5" fill="#2f4d5a" />
                </g>

                <!-- ============================================================ -->
                <!--  PERSONAJE 4: PSICÓLOGO (estilo Open Peeps)                    -->
                <g transform="translate(530, 180)" filter="url(#sombraPeep)">
                    <!-- Cuerpo (chaleco) -->
                    <rect x="25" y="35" width="48" height="80" rx="8" fill="#8f7a5a" stroke="#6d5d45" stroke-width="2" />
                    <!-- Cuello camisa -->
                    <path d="M36 35 L49 22 L62 35 L54 40 L49 32 L44 40 L36 35" fill="#f0e8dc" stroke="#d5c8b8" stroke-width="1.5" />
                    <!-- Cabeza -->
                    <circle cx="49" cy="18" r="18" fill="#f5d6b8" stroke="#dbb89a" stroke-width="2" />
                    <!-- Cabello y barba -->
                    <path d="M33 10 Q49 -6 65 10 Q70 20 58 24 Q49 18 40 24 Q28 20 33 10" fill="#6d4c2a" />
                    <path d="M38 30 Q49 38 60 30 Q54 34 49 32 Q44 34 38 30" fill="#6d4c2a" opacity="0.9" />
                    <!-- Ojos y sonrisa -->
                    <circle cx="41" cy="16" r="3" fill="#1d2b24" />
                    <circle cx="57" cy="16" r="3" fill="#1d2b24" />
                    <path d="M41 26 Q49 30 57 26" stroke="#1d2b24" stroke-width="2" fill="none" stroke-linecap="round" />
                    <!-- Brazos -->
                    <line x1="25" y1="52" x2="2" y2="70" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <line x1="73" y1="52" x2="96" y2="70" stroke="#f5d6b8" stroke-width="9" stroke-linecap="round" />
                    <!-- Piernas -->
                    <line x1="36" y1="115" x2="28" y2="148" stroke="#4a3d2e" stroke-width="9" stroke-linecap="round" />
                    <line x1="62" y1="115" x2="70" y2="148" stroke="#4a3d2e" stroke-width="9" stroke-linecap="round" />
                    <rect x="16" y="144" width="24" height="10" rx="5" fill="#3d2b1a" />
                    <rect x="58" y="144" width="24" height="10" rx="5" fill="#3d2b1a" />
                    <!-- Libreta / psicólogo -->
                    <rect x="90" y="50" width="20" height="28" rx="4" fill="#f0e8dc" stroke="#d5c8b8" stroke-width="1.5" transform="rotate(12, 98, 62)" />
                    <line x1="94" y1="60" x2="106" y2="60" stroke="#8f7a5a" stroke-width="1.5" transform="rotate(12, 98, 62)" />
                    <line x1="94" y1="66" x2="104" y2="66" stroke="#8f7a5a" stroke-width="1.5" transform="rotate(12, 98, 62)" />
                </g>

                <!-- Burbuja de diálogo (estilo plano) -->
                <g transform="translate(320, 120)">
                    <rect x="0" y="0" width="140" height="50" rx="24" fill="white" stroke="#c98a3e" stroke-width="2.5" />
                    <polygon points="40,50 50,68 60,50" fill="white" stroke="#c98a3e" stroke-width="2.5" stroke-linejoin="round" />
                    <text x="28" y="24" font-size="14" font-family="'Inter',sans-serif" fill="#1f4038" font-weight="600">Te acompañamos</text>
                    <text x="40" y="42" font-size="12" font-family="'Inter',sans-serif" fill="#4a5a50">siempre</text>
                </g>

                <!-- Cartel "SIAD" en la pared -->
                <rect x="350" y="30" width="90" height="38" rx="8" fill="#2f5d50" stroke="#1f4038" stroke-width="1.5" />
                <text x="378" y="55" font-size="18" font-family="'Lora',serif" fill="white" font-weight="600">SIAD</text>

                <!-- Etiquetas de los personajes (sutiles) -->
                <text x="215" y="400" font-size="11" font-family="'Inter',sans-serif" fill="#4a5a50" font-weight="500">Enfermera</text>
                <text x="420" y="400" font-size="11" font-family="'Inter',sans-serif" fill="#4a5a50" font-weight="500">Estudiante</text>
                <text x="715" y="400" font-size="11" font-family="'Inter',sans-serif" fill="#4a5a50" font-weight="500">Licenciada</text>
                <text x="565" y="365" font-size="11" font-family="'Inter',sans-serif" fill="#4a5a50" font-weight="500">Psicólogo</text>

            </svg>
        </div>

        <!-- Texto y botón de login (centrado) -->
        <div class="descripcion">
            <div>
                <h2>Bienestar estudiantil · <em>Universidad de Panamá</em></h2>
                <p>Registra tu caso, agenda citas y recibe acompañamiento de enfermería, psicología y orientación.</p>
            </div>
            <div>
                <a href="#" class="login-boton"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión</a>
                <span style="margin-left:12px; font-size:0.8rem; color:#8a998f;">|</span>
                <a href="#" class="btn btn-ghost" style="margin-left:8px;"><i class="bi bi-person-plus"></i> Registrarme</a>
            </div>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <span class="badge">SIAD · Sistema de Orientación y Bienestar</span>
            <span style="margin:0 12px;">•</span> © 2026 Universidad de Panamá
        </div>

    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\sistema_discapacidad\resources\views/welcome.blade.php ENDPATH**/ ?>