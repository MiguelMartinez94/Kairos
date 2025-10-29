<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreferenciaPaciente;
use App\Models\Paciente;

class PreferenciasController extends Controller
{
    
    public function create(Paciente $paciente)
    {

        return view('formulario_inicial.preferencias', ['paciente' => $paciente]);

    }


    public function store(Request $request)
    {
        PreferenciaPaciente::create($request->all());
        return redirect()->route('preferencias.mensaje');
    }

    public function show()
    {
        return view('formulario_inicial.mensaje');
    }

}
