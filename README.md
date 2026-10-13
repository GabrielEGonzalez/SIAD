# SIAD — Sistema Integral de Atención a la Discapacidad

Sistema web desarrollado como proyecto de tesis para apoyar la gestión y el seguimiento de casos relacionados con la atención a personas con discapacidad dentro del entorno institucional.

El propósito de SIAD es centralizar la información de los casos y facilitar tareas administrativas como el registro, el seguimiento, la programación de citas y la generación de reportes.

> **Estado del proyecto:** desarrollo académico en evolución. Las funciones descritas corresponden a los módulos identificados en el repositorio; su disponibilidad puede variar según la configuración y el estado actual de implementación.

## Objetivos

- Organizar la información relacionada con los casos de atención.
- Facilitar el registro y la consulta de información de estudiantes.
- Dar seguimiento a los casos y mantener un historial de atención.
- Gestionar citas y consultar eventos de agenda.
- Generar reportes de casos y documentos en formato PDF.

## Módulos principales

- **Autenticación y usuarios:** inicio de sesión, registro de usuarios y cierre de sesión.
- **Panel principal:** acceso al panel de la aplicación.
- **Registro de casos:** formularios relacionados con estudiantes y declaraciones de discapacidad.
- **Seguimiento:** creación de registros de seguimiento, consulta del historial y visualización del perfil asociado a un caso.
- **Agenda de citas:** consulta de citas, eventos y resúmenes; registro de citas y actualización de su estado.
- **Reportes:** consulta de información de casos, reportes estadísticos y generación de documentos PDF.

La disponibilidad de cada función depende de su implementación, las rutas habilitadas y la configuración del entorno.

## Tecnologías

| Tecnología | Uso |
|---|---|
| PHP 8.2 o superior | Lenguaje del servidor |
| Laravel 12 | Framework de la aplicación web |
| Composer | Gestión de dependencias de PHP |
| MySQL u otro motor compatible | Base de datos, según la configuración del proyecto |
| Node.js y npm | Herramientas para dependencias y recursos del frontend |
| Vite | Compilación y servidor de desarrollo de recursos |
| Tailwind CSS 4 | Estilos de la interfaz |
| barryvdh/laravel-dompdf | Generación de documentos PDF |

## Requisitos previos

Antes de instalar el proyecto, asegúrate de tener:

- PHP 8.2 o una versión compatible con las dependencias.
- Composer.
- Node.js y npm.
- Un motor de base de datos compatible y una base de datos preparada para SIAD.
- Git, para clonar el repositorio.

## Instalación local

### 1. Clonar el repositorio

```bash
git clone https://github.com/GabrielEGonzalez/SIAD.git
cd SIAD
```

### 2. Instalar las dependencias de PHP

```bash
composer install
```

### 3. Configurar el entorno

Copia el archivo de ejemplo de variables de entorno y genera la clave de Laravel:

```bash
cp .env.example .env
php artisan key:generate
```

En Windows puedes copiar `.env.example` como `.env` desde el explorador de archivos o ejecutar `copy .env.example .env` en CMD.

Edita `.env` y configura los datos de conexión de la base de datos, además de los demás servicios que utilice tu entorno local.

### 4. Instalar las dependencias del frontend

```bash
npm install
```

Para compilar los recursos:

```bash
npm run build
```

Durante el desarrollo, puedes usar:

```bash
npm run dev
```

### 5. Preparar la base de datos

Verifica que la base de datos de SIAD exista y que su estructura esté preparada antes de ejecutar migraciones. Revisa las migraciones disponibles y las instrucciones del proyecto para evitar modificar o perder datos de una base de datos existente.

Cuando hayas confirmado que las migraciones corresponden a tu instalación, puedes ejecutar:

```bash
php artisan migrate
```

### 6. Iniciar la aplicación

```bash
php artisan serve
```

Abre la dirección local que indique Laravel en la terminal, normalmente:

```
http://127.0.0.1:8000
```

## Dependencias que no se suben al repositorio

Las carpetas `vendor/` y `node_modules/` no necesitan versionarse: se generan al instalar las dependencias con Composer y npm. Por eso, no es necesario subirlas a GitHub, siempre que se incluyan los archivos de bloqueo y manifiestos correspondientes.

## Estructura general

```text
SIAD/
├── app/                 # Controladores, modelos y lógica de la aplicación
├── bootstrap/           # Inicialización de Laravel
├── config/              # Configuración
├── database/            # Migraciones, factories y seeders
├── public/              # Punto de entrada y recursos públicos
├── resources/           # Vistas y recursos del frontend
├── routes/              # Rutas web y de consola
├── storage/             # Archivos generados y registros
├── tests/               # Pruebas automatizadas
├── composer.json        # Dependencias PHP
├── composer.lock        # Versiones instaladas de dependencias PHP
├── package.json         # Dependencias y scripts frontend
├── package-lock.json    # Versiones instaladas de dependencias frontend
└── vite.config.js       # Configuración de Vite
```

## Consideraciones de seguridad

- No publiques el archivo `.env` ni credenciales, contraseñas o claves privadas.
- Usa datos ficticios al realizar demostraciones o pruebas.
- La información relacionada con discapacidad y atención puede ser sensible; limita el acceso a usuarios autorizados y evita subir datos reales al repositorio.
- Antes de desplegar el sistema, revisa la autenticación, autorización por roles, validaciones, protección de archivos y configuración de producción.

## Contexto académico

SIAD se desarrolla como proyecto de tesis en el área de Ingeniería en Informática. La documentación y las funciones del sistema pueden evolucionar a medida que avance el proyecto.

## Autor

**Gabriel Enrique Gonzalez**

- GitHub: [@GabrielEGonzalez](https://github.com/GabrielEGonzalez)
- Repositorio: [GabrielEGonzalez/SIAD](https://github.com/GabrielEGonzalez/SIAD)

---

Desarrollado con Laravel.
