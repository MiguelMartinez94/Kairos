<?php

use App\Http\Controllers\AgendasController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\FormularioInicialController;
use App\Http\Controllers\PreferenciasController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InicioController;


#Formulario Paciente
Route::get('/', [FormularioInicialController::class, 'index'])->name('formulario.index');
Route::post('/formulario/store', [FormularioInicialController::class, 'store'])->name('formulario.store');



#Preferencias Paciente

Route::get('/preferencias/{paciente}/create', [PreferenciasController::class, 'create'])->name('preferencias.create');
Route::post('/preferencias/{paciente}/store', [PreferenciasController::class, 'store'])->name('preferencias.store');
Route::get('/preferencias/mensaje', [PreferenciasController::class, 'show'])->name('preferencias.mensaje');


#Rutas protegidas
#Sección pacientes
Route::middleware(['auth:psicologos'])->group(function () {

Route::get('/pacientes/pendientes', [PacienteController::class, 'indexPendientes'])->name('pacientes.pendientes');
Route::get('/pacientes/activos', [PacienteController::class, 'indexActivos'])->name('pacientes.activos');
Route::put('/pacientes/{paciente}/aceptar', [PacienteController::class, 'aceptar'])->name('pacientes.aceptar');
Route::put('/pacientes/{paciente}/eliminar', [PacienteController::class, 'eliminar'])->name('pacientes.eliminar');
Route::post('/pacientes/{paciente}/clinicos/store', [PacienteController::class, 'storeClinicos'])->name('store.clinicos');


#Ruta para guardar datos de las sesión de un paciente

Route::post('/pacientes/sesion/store', [PacienteController::class, 'sesionStore'])->name('sesion.store');

Route::resource('/pacientes', PacienteController::class);


#Ruta para vista de inicio para psicóloga
Route::get('/inicio', [InicioController::class, 'index'])->name('psicologos.inicio');


#Rutas de agenda

#Rutas para mostrar agenda agenda
Route::get('/agenda', [AgendasController::class, 'index'])->name('psicologos.agenda');
Route::put('agenda/update/{agenda}', [AgendasController::class, 'update'])->name('agenda.update');


#Rutas para calendario
Route::get('/api/mis-citas', [InicioController::class, 'obtenerCitasJson'])->name('api.mis_citas');


});



#Login psicólogos

Route::get('/login/psicologos', [LoginController::class, 'loginPsicologos'])->name('psicologos.login');
Route::get('/registrar/psicologos', [LoginController::class, 'registroPsicologos'])->name('psicologos.registro');


Route::post('/registrar/psicologos', [LoginController::class, 'createRegistroPsicologo'])->name('psicologos.store');

#Ruta para iniciar sesión psicologos
Route::post('/login/psicologos', [LoginController::class, 'login'])->name('psicologos.login.attempt');

Route::post('/login/logout', [LoginController::class, 'logout'])->name('psicologos.logout');





require __DIR__.'/settings.php';
