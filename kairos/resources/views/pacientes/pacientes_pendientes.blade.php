@extends('layouts.app')

@section('content')

    @include('layouts._partials.nav')


    <ul>
        <li><a href="{{view('pacientes.pacientes_pendientes')}}">Pacientes Pendientes</a></li>
        <li><a href="{{view('pacientes.pacientes_activos')}}">Pacientes Activos</a></li>
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
                
                <div>s

                    <h2>Datos personales</h2>

                    <div>

                        <label for="">Nombre completo</label>
                        <p>{{$paciente->nombre}}</p>

                        <label for="">Edad</label>
                        <p>{{$paciente->edad}}</p>

                        <label for="">Género</label>
                        <p>{{$paciente->genero}}</p>

                        <label for="">Día solicitado</label>
                        <p>{{$paciente->preferencia->dia_preferido}}</p>

                        <label for="">Horario solicitado</label>
                        <p>{{$paciente->preferencia->horario_preferido}}</p>

                        <label for="">Número de teléfono</label>
                        <p>{{$paciente->telefono}}</p>

                        <label for="">Correo electrónico</label>
                        <p>{{$paciente->correo}}</p>


                    </div>

                    <button type="button" class="closeModalBtn">Mantener Pendiente</button>
                </div>
            </dialog>
        </div>
            
        @empty
            Aún no hay pacientes activos...            
        @endforelse
    </div>


    <script>
    // 1. Selecciona TODOS los botones que tienen la clase 'openModalBtn'
    const openButtons = document.querySelectorAll('.openModalBtn');

    // 2. Selecciona TODOS los botones que tienen la clase 'closeModalBtn'
    const closeButtons = document.querySelectorAll('.closeModalBtn');

    // 3. Añade un evento a CADA botón de "Abrir"
    openButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            
            // Prevenimos que el <form> se envíe (por si acaso)
            event.preventDefault(); 
            
            // Obtenemos el ID del modal desde el atributo 'data-modal-id' del botón
            const modalId = button.dataset.modalId;
            
            // Encontramos ese modal específico por su ID único
            const modal = document.getElementById(modalId);
            
            if (modal) {
                modal.showModal(); // ¡Y lo abrimos!
            }
        });
    });

    // 4. Añade un evento a CADA botón de "Cerrar"
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            
            // Encontramos el <dialog> más cercano al botón que se presionó
            const modal = button.closest('dialog');
            
            if (modal) {
                modal.close(); // ¡Y lo cerramos!
            }
        });
    });
</script>

    
@endsection