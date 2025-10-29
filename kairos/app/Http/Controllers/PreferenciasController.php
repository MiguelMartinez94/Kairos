<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreferenciaPacientes;
use App\Models\Paciente;

class PreferenciasController extends Controller
{
    
    public function create(Paciente $paciente)
    {

        return view('formulario_inicial.preferencias', compact('paciente'));

    }


    public function store(Request $request)
    {
        Preferencia::create($request-all());
        return redirect()->route('preferencias.mensaje');
    }

    public function show()
    {
        return view('formulario_inicial.menesaje');
    }

}
