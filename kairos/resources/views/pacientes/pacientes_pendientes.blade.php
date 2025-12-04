@extends('layouts.app')

@section('content')

    @include('layouts._partials.nav')

    <div class="pacientes-container">
        <ul class="tabs-nav">
            <li><a href="{{route('pacientes.pendientes')}}" class="active">Pacientes Pendientes</a></li>
            <li><a href="{{route('pacientes.activos')}}">Pacientes Activos</a></li>
        </ul>

        <div class="pacientes-grid">
            @forelse ($pacientes as $paciente)

            <div class="paciente-card pendiente">
                <div class="paciente-header">
                    <div class="paciente-imagen">
                        {{substr($paciente->nombre, 0, 1)}}
                    </div>
                    <div class="paciente-info">
                        <p>{{$paciente->nombre}} <span class="badge-pendiente">Pendiente</span></p>
                        <p>Edad: {{$paciente->edad}}</p>
                    </div>
                </div>

                <button type="button" class="openModalBtn btn-mostrar" data-modal-id="modal-{{$paciente->id}}">
                    Mostrar Información
                </button>

                <dialog id="modal-{{$paciente->id}}" class="modal-paciente modal-pendiente">
                    
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2>{{$paciente->nombre}}</h2>
                        </div>

                        <div class="datos-section">
                            <h2>Datos personales</h2>

                            <div class="datos-grid">
                                <div class="dato-item">
                                    <label>Nombre completo</label>
                                    <p>{{$paciente->nombre}}</p>
                                </div>

                                <div class="dato-item">
                                    <label>Edad</label>
                                    <p>{{$paciente->edad}}</p>
                                </div>

                                <div class="dato-item">
                                    <label>Género</label>
                                    <p>{{$paciente->genero}}</p>
                                </div>

                                <div class="dato-item">
                                    <label>Número de teléfono</label>
                                    <p>{{$paciente->telefono}}</p>
                                </div>

                                <div class="dato-item">
                                    <label>Correo electrónico</label>
                                    <p>{{$paciente->correo}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="preferencias-info">
                            <h3>Preferencias de horario</h3>
                            <div class="preferencias-grid">
                                <div class="preferencia-item">
                                    <label>Día solicitado</label>
                                    <p>{{$paciente->preferencia->dia_preferido}}</p>
                                </div>

                                <div class="preferencia-item">
                                    <label>Horario solicitado</label>
                                    <p>{{$paciente->preferencia->horario_preferido}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="closeModalBtn btn-secundario">Mantener Pendiente</button>
                            <form action="{{route('pacientes.aceptar', $paciente->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="submit" value="Aceptar paciente" class="btn-primario">
                            </form>
                        </div>

                    </div>
                </dialog>
            </div>
                
            @empty
            <div class="empty-state">
                <p>No hay pacientes pendientes...</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        const openButtons = document.querySelectorAll('.openModalBtn');

        const closeButtons = document.querySelectorAll('.closeModalBtn');

        openButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                
                event.preventDefault(); 
                
                const modalId = button.dataset.modalId;
                
                const modal = document.getElementById(modalId);
                
                if (modal) {
                    modal.showModal();
                }
            });
        });

        closeButtons.forEach(button => {
            button.addEventListener('click', () => {
                
                const modal = button.closest('dialog');
                
                if (modal) {
                    modal.close(); 
                }
            });
        });
    </script>
    
@endsection