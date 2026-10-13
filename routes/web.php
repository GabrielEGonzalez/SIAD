<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReportePDFController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\SeguimientoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckUserSession;
use App\Http\Middleware\Kernel;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/registrar', function () {
    return view('Registrar');
})->name('register');

Route::get('/panel', [DashboardController::class, 'index'])
    ->name('panel');

Route::get('/estudiante', function () {
    return view('EstudianteFORM');
})->name('estudiante');

Route::post('/registrarUser', [UsuarioController::class, 'register'])->name('registrarUser.store');

Route::post('/loginUser', [UsuarioController::class, 'login'])->name('loginUser.login');
Route::post('/registrar', [EstudianteController::class, 'store'])->name('discapacidad.store');
Route::get('/user', [UsuarioController::class, 'index']);

Route::get('/reportes/pdf/{idCaso}', [ReportePDFController::class, 'generarPDF'])
    ->name('reportes.pdf');
Route::get('/reportes/casos', [ReportePDFController::class, 'listaCasos'])
    ->name('reportes.casos');
Route::get('/reportes/estadisticos', [ReporteController::class, 'index'])->name('reportes.estadisticos');
Route::get('/reportes/{idCaso}', [ReporteController::class, 'show'])->name('reportes.show');
Route::post('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/reportes/pdf/general', [ReporteController::class, 'pdfGeneral'])
    ->middleware('admin')
    ->name('reportes.pdf.general');
// Dashboard del módulo citas
Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');

// JSON para FullCalendar
Route::get('/citas/json', [CitaController::class, 'json'])->name('citas.json');

Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');

// Endpoints JSON usados por la vista (pueden estar en web; usan GET/POST y CSRF)
Route::get('/citas/events', [CitaController::class, 'events'])->name('citas.events');
Route::get('/citas/summary', [CitaController::class, 'summary'])->name('citas.summary');

// Opcionales
Route::patch('/citas/{id}/estado', [CitaController::class, 'updateState'])->name('citas.updateState');
Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
// routes/web.php
Route::get('/api/citas', [CitaController::class, 'apiCitas'])->name('api.citas');

// Crear seguimiento
Route::get('/seguimiento/crear/{idCaso}', [SeguimientoController::class, 'create'])
    ->name('seguimiento.create');

// Guardar seguimiento
Route::post('/seguimiento/store', [SeguimientoController::class, 'store'])
    ->name('seguimiento.store');

// Historial
Route::get('/seguimiento/historial/{idCaso}', [SeguimientoController::class, 'historial'])
    ->name('seguimiento.historial');

// Perfil de estudiante
Route::get('/seguimiento/perfil/{idEstudiante}', [SeguimientoController::class, 'perfil'])
    ->name('seguimiento.perfil');
