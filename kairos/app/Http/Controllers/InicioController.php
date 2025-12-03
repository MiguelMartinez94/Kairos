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
            // 1. Traemos las preferencias (SIN el filtro estricto por ahora para que no falle)
            $preferencias = PreferenciaPaciente::with('paciente')->get();

            $eventos = [];

            // 2. Mapeo exacto para FullCalendar (0=Domingo, 1=Lunes...)
            $diasMap = [
                'domingo' => 0, 'lunes' => 1, 'martes' => 2, 
                'miercoles' => 3, 'jueves' => 4, 'viernes' => 5, 'sabado' => 6
            ];

            foreach ($preferencias as $pref) {
                // Limpieza del texto del día (quitar espacios, minúsculas)
                $diaTexto = strtolower(trim($pref->dia_preferido));
                
                // Quitamos acentos por si acaso (miércoles -> miercoles)
                $diaTexto = str_replace(['á','é','í','ó','ú'], ['a','e','i','o','u'], $diaTexto);

                if (isset($diasMap[$diaTexto]) && $pref->paciente) {
                    
                    $diaNumero = $diasMap[$diaTexto];
                    
                    // Calculamos hora fin (1 hora después del inicio)
                    $horaInicio = $pref->horario_preferido; 
                    $horaFin = Carbon::parse($horaInicio)->addHour()->format('H:i:s');

                    $eventos[] = [
                        'title'      => $pref->paciente->nombre, // Nombre del paciente
                        'daysOfWeek' => [$diaNumero],            // [1] para Lunes
                        'startTime'  => $horaInicio,             // "14:00:00"
                        'endTime'    => $horaFin,                // "15:00:00"
                        'color'      => '#3B82F6',               // Azul
                        'textColor'  => '#ffffff',
                    ];
                }
            }

            // DEBUG: Ver en storage/logs/laravel.log cuántos eventos encontró
            

            return response()->json($eventos);

        } catch (\Exception $e) {
            // Si falla, registramos el error y devolvemos un array vacío para no romper el JS
            
            return response()->json([]);
        }
    }

}
