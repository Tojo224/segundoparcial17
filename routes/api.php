<?php

use Illuminate\Support\Facades\Route;
use App\Modules\AdministracionUsuariosSeguridad\Controllers\{
    RolesController,
    UsuariosController,
    BitacoraController
};

/*
|--------------------------------------------------------------------------
| RUTAS API – Administración de Usuarios y Seguridad
|--------------------------------------------------------------------------
*/

Route::prefix('roles')->group(function () {
    Route::get('/', [RolesController::class, 'index']);          // Listar roles
    Route::get('/{id}', [RolesController::class, 'show']);       // Ver detalle
    Route::post('/', [RolesController::class, 'store']);         // Crear rol
    Route::put('/{id}', [RolesController::class, 'update']);     // Actualizar rol
    Route::delete('/{id}', [RolesController::class, 'destroy']); // Eliminar rol
});

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuariosController::class, 'index']);          // Listar usuarios
    Route::get('/{id}', [UsuariosController::class, 'show']);       // Ver detalle
    Route::post('/', [UsuariosController::class, 'store']);         // Crear usuario
    Route::put('/{id}', [UsuariosController::class, 'update']);     // Actualizar usuario
    Route::delete('/{id}', [UsuariosController::class, 'destroy']); // Eliminar usuario

    // Asignar rol a usuario
    Route::post('/{id}/asignar-rol', [UsuariosController::class, 'assignRole']);
});

Route::prefix('bitacora')->group(function () {
    Route::get('/', [BitacoraController::class, 'index']);       // Listar acciones
    Route::get('/{id}', [BitacoraController::class, 'show']);    // Ver detalle
});
