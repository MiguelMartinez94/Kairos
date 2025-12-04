<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\PreferenciaPaciente;
use Carbon\Carbon;

class InicioController extends Controller
{
    public function index()
    {

        $pacientes = Paciente::all();
        $preferencias = PreferenciaPaciente::all();

        return view('inicio.index', compact('pacientes', 'preferencias'));

    }

    public function obtenerCitasJson()
    {
        try {
            
            $preferencias = PreferenciaPaciente::with('paciente')->get();

            $eventos = [];

            
            $diasMap = [
                'domingo' => 0, 'lunes' => 1, 'martes' => 2, 
                'miercoles' => 3, 'jueves' => 4, 'viernes' => 5, 'sabado' => 6
            ];

            foreach ($preferencias as $pref) {
                
                $diaTexto = strtolower(trim($pref->dia_preferido));
                
                
                $diaTexto = str_replace(['á','é','í','ó','ú'], ['a','e','i','o','u'], $diaTexto);

                if (isset($diasMap[$diaTexto]) && $pref->paciente) {
                    
                    $diaNumero = $diasMap[$diaTexto];
                    
                    
                    $horaInicio = $pref->horario_preferido; 
                    $horaFin = Carbon::parse($horaInicio)->addHour()->format('H:i:s');

                    $eventos[] = [
                        'title'      => $pref->paciente->nombre, 
                        'daysOfWeek' => [$diaNumero],            
                        'startTime'  => $horaInicio,             
                        'endTime'    => $horaFin,                
                        'color'      => '#3B82F6',               
                        'textColor'  => '#ffffff',
                    ];
                }
            }

            
            

            return response()->json($eventos);

        } catch (\Exception $e) {
            
            return response()->json([]);
        }
    }

}
