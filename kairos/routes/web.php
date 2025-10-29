<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\FormularioInicialController;
use App\Http\Controllers\PreferenciasController;


#Formulario Paciente
Route::get('/', [FormularioInicialController::class, 'index'])->name('formulario.index');
Route::post('/paciente/store', [FormularioInicialController::class, 'store'])->name('formulario.store');



#Preferencias Paciente

Route::get('/preferencias/{paciente}/create', [PreferenciasController::class, 'create'])->name('preferencias.create');
Route::post('/preferencias/{paciente}/store', [PreferenciasController::class, 'store'])->name('preferencias.store');
Route::get('/preferencias/mensaje', [PreferenciasController::class, 'show'])->name('preferencias.mensaje');


require __DIR__.'/settings.php';
