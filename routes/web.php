<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Cargar rutas API (roles, usuarios, bitácora)
Route::prefix('api')->group(function () {
    require base_path('routes/api.php');
});
