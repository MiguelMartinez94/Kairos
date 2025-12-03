<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\PreferenciaPaciente;
use App\Models\Paciente;

class AgendasController extends Controller
{

    public function index()
    {
        $agendas = Agenda::all();
        $preferencias = PreferenciaPaciente::all();
        $pacientes = Paciente::all();
        return view('agenda.index', compact('agendas', 'preferencias', 'pacientes'));
    }

    public function update(Request $request, Agenda $agenda)
    {

        $agenda->update([

            'psicologo_id' => auth('psicologos')->id(),
            'dia_semana' => $agenda->dia_semana,
            'horario_inicio' => $request->horario_inicio,
            'horario_fin' => $request->horario_fin,
            'estado' => $request->estado

        ]);

        

        return redirect()->route('psicologos.agenda')->with('success', 'Horario de atención actualizado');

    }

}
