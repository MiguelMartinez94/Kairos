<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreferenciaPaciente;
use App\Models\Paciente;
use App\Http\Requests\PreferenciasRequest;

class PreferenciasController extends Controller
{
    
    public function create(Paciente $paciente)
    {

        return view('formulario_inicial.preferencias', ['paciente' => $paciente]);

    }


    public function store(PreferenciasRequest $request)
    {

        try {

            PreferenciaPaciente::create($request->all());
            return redirect()->route('preferencias.mensaje');
            
        } catch (\Exception $e) {
            
            return back()->with('danger', 'Ocurrió un error inesperado al registrar sus preferencias. Intente de nuevo');

        }

        
    }

    public function show()
    {
        return view('formulario_inicial.mensaje');
    }

}
