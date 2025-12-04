<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Agenda;
use App\Models\PreferenciaPaciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PreferenciasController extends Controller
{
    
    public function create($pacienteId)
    {
        $paciente = Paciente::findOrFail($pacienteId);
        
        
        $psicologoId = auth('psicologos')->id(); 

        
        $agendas = Agenda::where('psicologo_id', $psicologoId)
                            ->where('estado', 1) 
                            ->get();

        
        $disponibilidad = [];

        foreach ($agendas as $agenda) {
            
            
            $inicio = Carbon::parse($agenda->horario_inicio);
            $fin    = Carbon::parse($agenda->horario_fin);
            $horas  = [];

            
            while ($inicio->copy()->addHour()->lte($fin)) {
                
                
                $horaVista = $inicio->format('H:i');    
                $horaBD    = $inicio->format('H:i:s');  

                
                $ocupado = PreferenciaPaciente::query()
                    ->where('dia_preferido', $agenda->dia_semana)
                    ->where('horario_preferido', $horaBD) 
                    
                    
                    ->exists();

                
                if (!$ocupado) {
                    $horas[] = $horaVista; 
                }
                
                
                $inicio->addHour();
            }

            
            if (count($horas) > 0) {
                $disponibilidad[$agenda->dia_semana] = $horas;
            }
        }

        return view('formulario_inicial.preferencias', compact('paciente', 'disponibilidad'));
    }

    /**
     * Guardar las preferencias.
     */
    public function store(Request $request, $pacienteId)
    {
        
        $validated = $request->validate([
            'dia_preferido'     => 'required|string',
            'horario_preferido' => 'required', 
            'forma_pago'        => 'required|string',
            'tipo_sesion'       => 'required|string',
        ]);

        
        PreferenciaPaciente::create([
            'paciente_id'       => $pacienteId,
            'dia_preferido'     => $validated['dia_preferido'],
            'horario_preferido' => $validated['horario_preferido'],
            'forma_pago'        => $validated['forma_pago'],
            'tipo_sesion'       => $validated['tipo_sesion'],
        ]);

        
        return view('formulario_inicial.mensaje');
    }
}