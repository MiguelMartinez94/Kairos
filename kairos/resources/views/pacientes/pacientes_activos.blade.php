@extends('layouts.app')

@section('content')


@include('layouts._partials.nav')

<div class="pacientes-container">

    <ul class="tabs-nav">
        <li><a href="{{route('pacientes.pendientes')}}">Pacientes Pendientes</a></li>
        <li><a href="{{route('pacientes.activos')}}" class="active">Pacientes Activos</a></li>
    </ul>


    <div class="pacientes-grid">

        @forelse ($pacientes as $paciente)

        <div class="paciente-card">

            <div class="paciente-header">

                <div class="paciente-imagen">

                    {{substr($paciente->nombre, 0, 1)}}

                </div>

                <div class="paciente-info">

                    <p>{{$paciente->nombre}}</p>
                    <p>Edad: {{$paciente->edad}}</p>

                </div>
            </div>

            <button type="button" class="openModalBtn btn-mostrar" data-modal-id="modal-{{$paciente->id}}">Mostrar Información</button>

            <dialog id="modal-{{$paciente->id}}" class="modal-paciente">
                
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

                    <div class="datos-section">

                        <h2>Datos clínicos</h2>

                        <div class="datos-grid">

                            <div class="dato-item">
                                <label>Información clínica</label>
                                <p>Pendiente de agregar...</p>
                            </div>

                        </div>

                    </div>

                    <div class="datos-section">

                        <h2>Observaciones</h2>

                        <div class="datos-grid">

                            <div class="dato-item">
                                <label>Notas</label>
                                <p>Sin observaciones registradas</p>
                            </div>

                        </div>

                    </div>
                    
                    <div class="modal-actions">

                        <button type="button" class="closeModalBtn btn-cerrar-modal">Cerrar</button>
                        <button type="button" class="openEditModalBtn btn-modificar" data-edit-modal-id="editModal-{{$paciente->id}}">Modificar</button>
                        <form action="{{route('pacientes.eliminar', $paciente->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="submit" value="Eliminar paciente" class="btn-eliminar">
                        </form>

                    </div>

                </div>

            </dialog>

            <dialog id="editModal-{{$paciente->id}}" class="modal-paciente modal-edit">
    
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h2>Editar paciente: {{$paciente->nombre}}</h2>
                    </div>

                    <form action="{{route('pacientes.update', $paciente->id)}}" method="POST">

                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="">Nombre completo</label>
                            <input type="text" placeholder="Ingresa tu nombre completo" name="nombre" value="{{$paciente->nombre}}">
                        </div>

                        <div class="form-group">
                            <label for="">Edad</label>
                            <input type="number" name="edad" value="{{$paciente->edad}}">
                        </div>

                        <div class="form-group">

                            <label for="">Género</label>
                            <select name="genero">
                                <option value="" selected>Selecciona tu género</option>
                                <option value="Masculino" @selected($paciente->genero == 'Masculino')>Masculino</option>
                                <option value="Femenino" @selected($paciente->genero == 'Femenino')>Femenino</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="">Teléfono</label>
                            <input type="text" name="telefono" value="{{$paciente->telefono}}">
                        </div>

                        <div class="form-group">
                            <label for="">Correo</label>
                            <input type="email" name="correo" value="{{$paciente->correo}}">
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="closeEditModalBtn btn-cerrar-modal">Cancelar</button>
                            <button type="submit" class="btn-modificar">Guardar cambios</button>
                        </div>

                    </form>

                </div>

            </dialog>
        </div>
            
        @empty

            <div class="empty-state">
                <p>No hay pacientes activos...</p>
            </div>         

        @endforelse
    </div>
</div>


<script>
    
    const openButtons = document.querySelectorAll('.openModalBtn');
    const closeButtons = document.querySelectorAll('.closeModalBtn');

    
    const openEditButtons = document.querySelectorAll('.openEditModalBtn');
    const closeEditButtons = document.querySelectorAll('.closeEditModalBtn');

    
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

    openEditButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const editModalId = button.dataset.editModalId;
            const editModal = document.getElementById(editModalId);
            
            if (editModal) {
                editModal.showModal();
            }
        });
    });

    closeEditButtons.forEach(button => {
        button.addEventListener('click', () => {
            const editModal = button.closest('dialog');
            if (editModal) {
                editModal.close();
            }
        });
    });
</script>
    
@endsection