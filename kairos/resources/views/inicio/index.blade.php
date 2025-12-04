@extends('layouts.app')

@section('content')

@include('layouts._partials.nav')


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
                
                
                <div id="calendar" style="min-height: 600px; background: white;"></div>

            </div>
        </div>
        
        <div class="dashboard-sidebar">
            <div class="sidebar-card">
                <h3 class="sidebar-title">Próximas Sesiones</h3>
                
                <div class="sesiones-list">
                    @forelse ($pacientes as $paciente)
                        
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



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            
            initialView: 'timeGridWeek', 
            
            
            locale: 'es', 
            

            firstDay: 1,              
            slotMinTime: '07:00:00',  
            slotMaxTime: '21:00:00',  
            allDaySlot: false,        
            height: 'auto',           
            expandRows: true,         

            
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            
            events: "{{ route('api.mis_citas') }}",
            
            eventClick: function(info) {
                
                alert('Paciente: ' + info.event.title + '\nHorario: ' + info.event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}));
            },

            
            eventMouseEnter: function(info) {
                info.el.style.cursor = 'pointer';
            }
        });

        calendar.render();
    });
</script>

@endsection