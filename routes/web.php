<?php

use App\Http\Controllers\ExportacionesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/returnHome', [App\Http\Controllers\HomeController::class, 'index2'])->name('returnHome');
Route::get('/master', [App\Http\Controllers\HomeController::class, 'master'])->name('master');
Route::get('/seguimiento', [App\Http\Controllers\HomeController::class, 'seguimiento'])->name('seguimiento');
Route::post('/registrarSeguimiento', [App\Http\Controllers\HomeController::class, 'registrarSeguimiento'])->name('registrarSeguimiento');
Route::post('/agregarMedicamento', [App\Http\Controllers\HomeController::class, 'agregarMedicamento2'])->name('agregarMedicamento');
Route::get('/enHospital', [App\Http\Controllers\HomeController::class, 'enHospital'])->name('enHospital');
Route::post('/registrarSeguimiento2', [App\Http\Controllers\HomeController::class, 'registrarSeguimiento2'])->name('registrarSeguimiento2');
Route::get('/seguimientoTratamiento', [App\Http\Controllers\HomeController::class, 'seguimientoTratamiento'])->name('seguimientoTratamiento');
Route::get('/seguimientoTratamientoId/{paciente}', [App\Http\Controllers\HomeController::class, 'seguimientoTratamientoId'])->name('seguimientoTratamiento');
Route::get('/cambios/{paciente}/{hospital}', [App\Http\Controllers\HomeController::class, 'cambios'])->name('cambios');
Route::post('/actualizacionCambios', [App\Http\Controllers\HomeController::class, 'actualizacionCambios'])->name('actualizacionCambios');
Route::get('/datosPaciente/{paciente}/{hospital}', [App\Http\Controllers\HomeController::class, 'datosPaciente'])->name('datosPaciente');
Route::get('/exportar', [App\Http\Controllers\HomeController::class, 'exportar'])->name('exportar');
Route::get('/exportarPacientes', [App\Http\Controllers\HomeController::class, 'exportarPacientes'])->name('exportarPacientes');
Route::get('/exportarIngresos', [App\Http\Controllers\HomeController::class, 'exportarIngresos'])->name('exportarIngresos');
Route::get('/exportarSignos', [App\Http\Controllers\HomeController::class, 'exportarSignos'])->name('exportarSignos');
Route::get('/exportarTratamiento', [App\Http\Controllers\HomeController::class, 'exportarTratamiento'])->name('exportarTratamiento');
Route::get('/exportarHospitalizacion', [App\Http\Controllers\HomeController::class, 'exportarHospitalizacion'])->name('exportarHospitalizacion');
Route::get('/exportDinamica/{tipo}/{fecha_i}/{fecha_f}', [ExportacionesController::class, 'exportToExcel'])->name('exportToExcel');
Route::get('/salidaHospitalizacion/{id}', [App\Http\Controllers\HomeController::class, 'salidaHospitalizacion'])->name('salidaHospitalizacion');
Route::post('/exportToExcelFiltrado', [ExportacionesController::class, 'exportToExcelFiltrado'])->name('exportToExcelFiltrado');
Route::post('/actualizarPaciente', [App\Http\Controllers\HomeController::class, 'actulizarPaciente'])->name('actulizarPaciente');
Route::get('/reporteServicio', [App\Http\Controllers\HomeController::class, 'reporteServicio'])->name('reporteServicio');
Route::post('/actualizarContra', [App\Http\Controllers\HomeController::class, 'actualizarContra'])->name('actualizarContra');



