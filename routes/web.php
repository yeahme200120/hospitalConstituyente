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
