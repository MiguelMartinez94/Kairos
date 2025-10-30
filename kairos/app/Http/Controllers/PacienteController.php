<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\PreferenciaPaciente;

class PacienteController extends Controller
{

    public function index()
    {
        // Redirigir al listado de pendientes
        return redirect()->route('pacientes.pendientes');
    }
    /**
     * Display a listing of the resource.
     */
    public function indexPendientes()
    {

        $pacientes = Paciente::with('preferencia')->where('estado', 0)->get();
        return view('pacientes.pacientes_pendientes', compact('pacientes'));
    }

    public function indexActivos()
    {

        $pacientes = Paciente::with('preferencia')->where('estado', 1)->get();
        return view('pacientes.pacientes_activos', compact('pacientes'));
    }

    public function aceptar($id)
    {
        $paciente = Paciente::findOrFail($id);

        $paciente->estado = 1;

        $paciente->save();

        return redirect()->route('pacientes.pendientes');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.pacientes_pendientes', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return redirect()->route('pacientes.activos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        
    }

    public function eliminar($id)
    {
        $paciente = Paciente::findOrFail($id);

        $paciente->estado = 2;

        $paciente->save();

        return redirect()->route('pacientes.activos');
    }
}
