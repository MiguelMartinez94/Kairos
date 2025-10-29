<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrefernciaPaciente;
use App\Models\Paciente;

class FormularioInicialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('formulario_inicial.registrar_datos');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Paciente $paciente)
    {
        $nuevoPaciente = Paciente::create($request->all());
        return redirect()->route('preferencias.create', ['paciente' => $nuevoPaciente->id]);
        
    }

    

}
