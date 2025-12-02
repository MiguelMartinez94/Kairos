<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Clinico;
use App\Models\Sesion;
use APP\Models\Psicologo;
use App\Models\PreferenciaPaciente;
use App\Http\Requests\PacienteRequest;
use Illuminate\Container\Attributes\Auth;


class PacienteController extends Controller
{

    public function index()
    {

        return redirect()->route('pacientes.pendientes');
    }

    public function indexPendientes()
    {


        try {
        
            $pacientes = Paciente::with('preferencia')->where('estado', 0)->get();
            return view('pacientes.pacientes_pendientes', compact('pacientes'));

        } catch (\Exception $e) {
            
            return back()->with('danger', 'No se pudieron cargar los datos de pacientes pendiente. Recargue la página');

        }

        
    }

    public function indexActivos()
    {


        try {
            
        $pacientes = Paciente::with('preferencia')->where('estado', 1)->get();
        $clinicos = Clinico::all();
        $psicologos = Psicologo::all();
        $sesiones = Sesion::all();
        return view('pacientes.pacientes_activos', compact('pacientes', 'clinicos', 'psicologos', 'sesiones'));

        } catch (\Exception $e) {
            
            return back()->with('danger', 'No se pudieron cargar los datos de pacientes activos. Recargue la página.');

        }

        
    }

    public function aceptar($id)
    {

        try {

            $paciente = Paciente::findOrFail($id);

            $paciente->estado = 1;

            $paciente->save();

            return redirect()->route('pacientes.pendientes')->with('success', 'Paciente aceptado');

        } catch (\Exception $e) {

            return back()->with('danger', 'Ocurrió un error inesperado. Intente de nuevo');
            
        }

        
    }


    public function show(Paciente $paciente)
    {
        return view('pacientes.pacientes_pendientes', compact('paciente'));
    }



    public function update(PacienteRequest $request, Paciente $paciente)
    {

        try {

            $paciente->update($request->all());
            return redirect()->route('pacientes.activos')->with('success', 'Paciente modificado');
            
        } catch (\Exception $e) {
            
            return back()->with('danger', 'Ocurrió un error al actualizar los datos del paciente. Intente de nuevo');

        }

        
    }


    public function eliminar($id)
    {

        try {

            $paciente = Paciente::findOrFail($id);

            $paciente->estado = 2;

            $paciente->save();

            return redirect()->route('pacientes.activos')->with('danger', 'Paciente eliminado');
                
        } catch (\Exception $e) {
            
            return back()->with('danger', 'Ocurrió un error inesperado. Intente de nuevo');

        }


        
    }


    public function storeClinicos(Request $request){

        Clinico::create($request->all());
        return redirect()->route('pacientes.activos');

    }

    public function sesionStore(Request $request)
    {
        Sesion::create([

            'psicologo_id' => auth('psicologos')->id(),
            'paciente_id' => $request -> paciente_id,
            'fecha_sesion' => $request-> fecha_sesion,
            'duracion' => $request-> duracion,
            'notas' => $request->notas


        ]);
        return redirect()->route('pacientes.activos');
    }
    
}
