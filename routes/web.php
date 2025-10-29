<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AdministracionUsuariosSeguridad\Controllers\Auth\LoginController;

Route::get('/', function () { return redirect('/login'); });

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboards por rol → renderizan el mismo dashboard (filtrado en frontend)
Route::middleware('auth')->group(function () {
    Route::get('/admin', fn () => view('administracion_usuarios_seguridad.dashboard'))->name('admin.dashboard');
    Route::get('/decano', fn () => view('administracion_usuarios_seguridad.dashboard'))->name('decano.dashboard');
    Route::get('/vicedecano', fn () => view('administracion_usuarios_seguridad.dashboard'))->name('vicedecano.dashboard');
    Route::get('/director', fn () => view('administracion_usuarios_seguridad.dashboard'))->name('director.dashboard');
    Route::get('/docente', fn () => view('administracion_usuarios_seguridad.dashboard'))->name('docente.dashboard');
    Route::get('/home', fn () => view('administracion_usuarios_seguridad.dashboard'))->name('home');
});

// Cargar rutas API (roles, usuarios, bitácora)
Route::prefix('api')->group(function () {
    require base_path('routes/api.php');
});
