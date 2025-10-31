<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\FormularioInicialController;
use App\Http\Controllers\PreferenciasController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\LoginController;


#Formulario Paciente
Route::get('/', [FormularioInicialController::class, 'index'])->name('formulario.index');
Route::post('/formulario/store', [FormularioInicialController::class, 'store'])->name('formulario.store');

#Ruta para vista de inicio para psicóloga
Route::view('/inicio', 'inicio.index')->name('psicologos.inicio');

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


#Login psicólogos

Route::get('/login/psicologos', [LoginController::class, 'loginPsicologos'])->name('psicologos.login');
Route::get('/registrar/psicologos', [LoginController::class, 'registroPsicologos'])->name('psicologos.registro');

Route::post('/registrar/psicologos', [LoginController::class, 'createRegistroPsicologo'])->name('psicologos.store');

#Ruta para iniciar sesión psicologos
Route::post('/login/psicologos', [LoginController::class, 'login'])->name('psicologos.login.attempt');


#Rutas para mostrar agenda agenda
Route::view('/agenda', 'agenda.index')->name('psicologos.agenda');


require __DIR__.'/settings.php';
