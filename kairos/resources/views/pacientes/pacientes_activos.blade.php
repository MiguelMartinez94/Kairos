@extends('layouts.app')

@section('content')


@include('layouts._partials.nav')


    <ul>
        <li><a href="{{route('pacientes.pendientes')}}">Pacientes Pendientes</a></li>
        <li><a href="{{route('pacientes.activos')}}">Pacientes Activos</a></li>
    </ul>


    <div style="border: solid 1px">
        @forelse ($pacientes as $paciente)

        <div style="border: solid 1px">

            <img src="#" alt="Imagen genérica de paciente">
            <p>Nombre: {{$paciente->nombre}}</p>
            <p>Edad: {{$paciente->edad}}</p>

            <button type="button" class="openModalBtn" data-modal-id="modal-{{$paciente->id}}">
                Mostrar Información
            </button>

            <dialog id="modal-{{$paciente->id}}">
                
                <div style="border: solid 1px">

                    <h2>Datos personales</h2>

                    <div style="border: solid 1px">

                        <label for="">Nombre completo</label>
                        <p>{{$paciente->nombre}}</p>

                        <label for="">Edad</label>
                        <p>{{$paciente->edad}}</p>

                        <label for="">Género</label>
                        <p>{{$paciente->genero}}</p>

                        <label for="">Número de teléfono</label>
                        <p>{{$paciente->telefono}}</p>

                        <label for="">Correo electrónico</label>
                        <p>{{$paciente->correo}}</p>


                    </div>

                    <div style="border: 1px">
                    
                        <h1>Datos clínicos</h1>
                            <div style="border: 1px">

                                

                            </div>

                            <h1>Observaciones</h1>

                            <div style="border: solid 1px">

                                

                            </div>

                    </div>

                    <button type="button" class="closeModalBtn">Cerrar</button>
                    <button type="button" class="openEditModalBtn" data-edit-modal-id="editModal-{{$paciente->id}}">Modificar paciente</button>
                    <form action="{{route('pacientes.eliminar', $paciente->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="submit" value="Eliminar paciente">
                    </form>

                </div>

            </dialog>

            <dialog  id="editModal-{{$paciente->id}}" >

                <h2>Editar paciente: {{$paciente->nombre}}</h2>

                <div>

                    <form action="{{route('pacientes.update', $paciente->id)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="">Nombre completo</label>
                        <input type="text" placeholder="Ingresa tu nombre completo" name="nombre" value="{{$paciente->nombre}}">

                        <label for="">Edad</label>
                        <input type="number" name="edad" value="{{$paciente->edad}}">

                        <label for="">Género</label>
                        <select name="genero" >
                            <option value="" selected>Selecciona tu género</option>
                            <option value="Masculino" @selected($paciente->genero == 'Masculino')>Masculino</option>
                            <option value="Femenino" @selected($paciente->genero == 'Femenino')>Femenino</option>
                        </select>

                        <label for="">Teléfono</label>
                        <input type="text" name="telefono" value="{{$paciente->telefono}}">

                        <label for="">correo</label>
                        <input type="email" name="correo" value="{{$paciente->correo}}">

                        <input type="submit" value="Guardar cambios">
                        <button type="button" class="closeEditModalBtn">Cancelar</button>


                    </form>

                </div>

            </dialog>
        </div>
            
        @empty
            No hay pacientes activos...            
        @endforelse
    </div>


    <script>
    // Botones para abrir modal principal
    const openButtons = document.querySelectorAll('.openModalBtn');
    const closeButtons = document.querySelectorAll('.closeModalBtn');

    // Botones para abrir modal de edición
    const openEditButtons = document.querySelectorAll('.openEditModalBtn');
    const closeEditButtons = document.querySelectorAll('.closeEditModalBtn');

    // Abrir modal principal
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

    // Cerrar modal principal
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('dialog');
            if (modal) {
                modal.close();
            }
        });
    });

    // Abrir modal de edición (DENTRO del modal principal)
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

    // Cerrar modal de edición
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