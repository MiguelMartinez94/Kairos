@extends('layouts.app')

@section('content')

@include('layouts._partials.nav')


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

<div class="agenda-container">
    
    <div class="agenda-header">
        <h1 class="page-title">Mi Agenda</h1>
        <button id="openModalBtn" class="btn-config-horarios">
            <span class="btn-icon">⚙️</span>
            <span>Configurar Horarios</span>
        </button>
    </div>
    
    
    <dialog id="myModal" class="modal-horarios">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Configurar Horarios de Atención</h2>
            </div>

            <div class="horarios-config-wrapper">
                @foreach ($agendas as $agenda)
                    <div class="dia-config-card">
                        <form action="{{route('agenda.update', $agenda)}}" method="POST" class="form-horario">
                            @method('PUT')
                            @csrf
                            
                            <div class="dia-header">
                                <h3 class="dia-nombre">{{$agenda->dia_semana}}</h3>
                                
                                <div class="estado-toggle">
                                    <label class="radio-label">
                                        <input type="radio" name="estado" value="1" {{$agenda->estado == 1 ? 'checked' : ''}}>
                                        <span class="radio-text activo">Activo</span>
                                    </label>

                                    <label class="radio-label">
                                        <input type="radio" name="estado" value="0" {{$agenda->estado == 0 ? 'checked' : ''}}>
                                        <span class="radio-text inactivo">Inactivo</span>
                                    </label>
                                </div>
                            </div>

                            <div class="horarios-inputs">
                                <div class="form-group">
                                    <label>Hora de inicio</label>
                                    <input type="time" name="horario_inicio" value="{{$agenda->horario_inicio}}">
                                </div>

                                <div class="form-group">
                                    <label>Hora de finalización</label>
                                    <input type="time" name="horario_fin" value="{{$agenda->horario_fin}}">
                                </div>
                            </div>
                            
                            <div class="form-actions-inline">
                                <button type="submit" class="btn-guardar-small">Guardar</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="modal-footer">
                <button type="button" id="closeModalBtn" class="btn-secundario">Cerrar</button>
            </div>
        </div>
    </dialog>
    
    <div class="agenda-grid">
        
        <div class="agenda-main">
            <div class="calendario-card">
                <h2 class="card-title">Calendario</h2>
                
                
                <div id="calendar" style="min-height: 600px; background: white; padding: 10px; border-radius: 8px;"></div>

            </div>
        </div>
        
        <div class="agenda-sidebar">
            
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
                                
                                @php
                                    $miPreferencia = $preferencias->where('paciente_id', $paciente->id)->first();
                                @endphp

                                @if($miPreferencia)
                                    <p>Día: {{ $miPreferencia->dia_preferido }}</p>
                                    <p>Hora: {{ $miPreferencia->horario_preferido }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="sesiones-empty-small">
                            <p>No hay sesiones próximas</p>
                        </div>
                    @endforelse
                </div>
            </div>
            
            <div class="sidebar-card">
                <h3 class="sidebar-title">Horarios de Atención</h3>
                <div class="horarios-list">
                    @foreach ($agendas as $agenda)
                        <div class="horario-item {{$agenda->estado == 1 ? 'activo' : 'inactivo'}}">
                            <div class="horario-dia">
                                <span class="dia-badge">{{substr($agenda->dia_semana, 0, 3)}}</span>
                                <span class="dia-completo">{{$agenda->dia_semana}}</span>
                            </div>
                            <div class="horario-horas">
                                @if($agenda->estado == 1)
                                    <span class="hora-inicio">{{$agenda->horario_inicio}}</span>
                                    <span class="separador">-</span>
                                    <span class="hora-fin">{{$agenda->horario_fin}}</span>
                                @else
                                    <span class="no-disponible">No disponible</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    
    const modal = document.getElementById('myModal');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');

    const openModal = () => {
        modal.showModal(); 
    };

    const closeModal = () => {
        modal.close();
    };

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);


    
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
                alert('Paciente: ' + info.event.title);
            },
            
            
            eventMouseEnter: function(info) {
                info.el.style.cursor = 'pointer';
            }
        });

        calendar.render();
    });
</script>
    
@endsection