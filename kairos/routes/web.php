<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\FormularioInicialController;
use App\Http\Controllers\PreferenciasController;
use App\Http\Controllers\PacienteController;


#Formulario Paciente
Route::get('/', [FormularioInicialController::class, 'index'])->name('formulario.index');
Route::post('/formulario/store', [FormularioInicialController::class, 'store'])->name('formulario.store');



#Preferencias Paciente

Route::get('/preferencias/{paciente}/create', [PreferenciasController::class, 'create'])->name('preferencias.create');
Route::post('/preferencias/{paciente}/store', [PreferenciasController::class, 'store'])->name('preferencias.store');
Route::get('/preferencias/mensaje', [PreferenciasController::class, 'show'])->name('preferencias.mensaje');

#Sección pacientes

Route::get('/pacientes/pendientes', [PacienteController::class, 'indexPendientes'])->name('pacientes.pendientes');
Route::get('/pacientes/activos', [PacienteController::class, 'indexActivos'])->name('pacientes.activos');
Route::put('/pacientes/{paciente}/aceptar', [PacienteController::class, 'aceptar'])->name('pacientes.aceptar');
Route::put('/pacientes/{paciente}/eliminar}', [PacienteController::class, 'eliminar'])->name('pacientes.eliminar');

Route::resource('/pacientes', PacienteController::class);


require __DIR__.'/settings.php';
