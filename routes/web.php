<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/master', [App\Http\Controllers\HomeController::class, 'master'])->name('master');
Route::get('/seguimiento', [App\Http\Controllers\HomeController::class, 'seguimiento'])->name('seguimiento');
Route::post('/registrarSeguimiento', [App\Http\Controllers\HomeController::class, 'registrarSeguimiento'])->name('registrarSeguimiento');
Route::get('/enHospital', [App\Http\Controllers\HomeController::class, 'enHospital'])->name('enHospital');
Route::post('/registrarSeguimiento2', [App\Http\Controllers\HomeController::class, 'registrarSeguimiento2'])->name('registrarSeguimiento2');
Route::get('/seguimientoTratamiento', [App\Http\Controllers\HomeController::class, 'seguimientoTratamiento'])->name('seguimientoTratamiento');
Route::get('/cambios/{paciente}', [App\Http\Controllers\HomeController::class, 'cambios'])->name('cambios');
Route::post('/actualizacionCambios', [App\Http\Controllers\HomeController::class, 'actualizacionCambios'])->name('actualizacionCambios');
Route::get('/datosPaciente/{paciente}', [App\Http\Controllers\HomeController::class, 'datosPaciente'])->name('datosPaciente');

