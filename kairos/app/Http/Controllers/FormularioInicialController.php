<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrefernciaPaciente;
use App\Models\Paciente;
use App\Http\Requests\PacienteRequest;

class FormularioInicialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('formulario_inicial.registrar_datos');

    }

    public function store(PacienteRequest $request, Paciente $paciente)
    {

        try {

            $nuevoPaciente = Paciente::create($request->all());
            return redirect()->route('preferencias.create', ['paciente' => $nuevoPaciente->id]);

        } catch (\Exception $e) {

            return back()->with('danger', 'Ocurrió un error inesperado. Intente de nuevo');
            
        }
        
        
    }

    

}
