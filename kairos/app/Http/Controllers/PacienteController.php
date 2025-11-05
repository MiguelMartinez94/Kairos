<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\PreferenciaPaciente;

class PacienteController extends Controller
{

    public function index()
    {
        return redirect()->route('pacientes.pendientes');
    }

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

        return redirect()->route('pacientes.pendientes')->with('success', 'Paciente aceptado');
    }


    public function show(Paciente $paciente)
    {
        return view('pacientes.pacientes_pendientes', compact('paciente'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(PacienteRequest $request, Paciente $paciente)
    {
        $paciente->update($request->all());
        return redirect()->route('pacientes.activos')->with('success', 'Paciente modificado');
    }


    public function eliminar($id)
    {
        $paciente = Paciente::findOrFail($id);

        $paciente->estado = 2;

        $paciente->save();

        return redirect()->route('pacientes.activos')->with('danger', 'Paciente eliminado');
    }
}
