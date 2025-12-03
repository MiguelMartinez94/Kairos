@extends('layouts.app')

@section('content')

@include('layouts._partials.nav')

{{-- 1. Importamos FullCalendar desde CDN --}}
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

<div class="dashboard-container">
    
    <div class="dashboard-header">
        <h1 class="page-title">Inicio</h1>
        <p class="page-subtitle">Bienvenido a tu panel de control</p>
    </div>

    <div class="dashboard-grid">
        
        <div class="dashboard-main">
            <div class="calendario-card">
                <h2 class="card-title">Mi Calendario</h2>
                
                {{-- 
                    2. REEMPLAZO DEL PLACEHOLDER 
                    Quitamos el div gris y ponemos el contenedor real.
                    Le damos una altura fija para que se vea bien.
                --}}
                <div id="calendar" style="min-height: 600px; background: white;"></div>

            </div>
        </div>
        
        <div class="dashboard-sidebar">
            <div class="sidebar-card">
                <h3 class="sidebar-title">Próximas Sesiones</h3>
                
                <div class="sesiones-list">
                    @forelse ($pacientes as $paciente)
                        {{-- (Tu código del sidebar se queda igual, está perfecto) --}}
                        <div class="sesion-preview-card">
                            <div class="paciente-avatar-small">
                                {{substr($paciente->nombre, 0, 1)}}
                            </div>
                            <div class="sesion-info-preview">
                                <p class="paciente-nombre-small">{{$paciente->nombre}}</p>
                                
                                @foreach ($preferencias as $preferencia)
                                    @if($preferencia->paciente_id == $paciente->id)
                                        <div class="sesion-detalles-small">
                                            <p class="sesion-dia">{{$preferencia->dia_preferido}}</p>
                                            <p class="sesion-hora">{{$preferencia->horario_preferido}}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="sesiones-empty-small">
                            <div class="empty-icon-small">📋</div>
                            <p>No hay sesiones programadas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
    </div>
</div>

{{-- Coloca esto al final de tu sección @section('content') --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            // VISTA: Semanal por horas (Ideal para psicólogos)
            initialView: 'timeGridWeek', 
            
            // IDIOMA: Español
            locale: 'es', 
            
            // CONFIGURACIÓN VISUAL
            firstDay: 1,              // La semana empieza el Lunes (1)
            slotMinTime: '07:00:00',  // Hora visual de inicio (7 am)
            slotMaxTime: '21:00:00',  // Hora visual de fin (9 pm)
            allDaySlot: false,        // Ocultar la fila de "todo el día"
            height: 'auto',           // Altura automática
            expandRows: true,         // Expande las filas para llenar el espacio

            // CABECERA
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            // --- AQUÍ ESTÁ EL AJUSTE ---
            // Conectamos con la ruta de tu API que devuelve el JSON
            // Blade renderiza la URL antes de que el navegador ejecute el JS
            events: "{{ route('api.mis_citas') }}",
            // ---------------------------

            // OPCIONAL: Qué pasa cuando haces clic en una cita
            eventClick: function(info) {
                // info.event contiene los datos (title, start, etc.)
                alert('Paciente: ' + info.event.title + '\nHorario: ' + info.event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
            },

            // OPCIONAL: Tooltip simple al pasar el mouse
            eventMouseEnter: function(info) {
                info.el.style.cursor = 'pointer';
            }
        });

        calendar.render();
    });
</script>

@endsection