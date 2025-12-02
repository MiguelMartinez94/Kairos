@extends('layouts.app')

@section('content')
    
@include('layouts._partials.nav')


    <ul class="tabs-nav">

        <li><a href="{{route('pacientes.pendientes')}}">Pacientes Pendientes</a></li>

        <li><a href="{{route('pacientes.activos')}}" class="active">Pacientes Activos</a></li>

    </ul>

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
                
                <div class="modal-tabs-nav" style="display: flex; gap: 10px; margin-top: 10px; border-bottom: 1px solid #ccc;">
                    <button type="button" class="tab-link active" onclick="openTab(event, 'general-{{$paciente->id}}')" style="padding: 10px; cursor: pointer; border: none; background: none; border-bottom: 2px solid black; font-weight: bold;">Información general</button>
                    <button type="button" class="tab-link" onclick="openTab(event, 'sesiones-{{$paciente->id}}')" style="padding: 10px; cursor: pointer; border: none; background: none;">Historial de sesiones</button>
                </div>
            </div>
            
            <div id="general-{{$paciente->id}}" class="tab-content" style="display: block;">
                
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
                    
                    @forelse ($clinicos as $clinico)
                        
                    <div>

                        <label for="">Fecha de inicio</label>
                        <p>{{$clinico->fecha_inicio}}</p>

                    </div>

                    <div>

                        <label for="">Diagnóstico</label>
                        <p>{{$clinico->diagnostico}}</p>
                    </div>

                    <div>

                        <label for="">Tratamiento</label>
                        <p>{{$clinico->tratamiento}}</p>

                    </div>
                    
                </div>

                    

                <div class="datos-section">
                    <h2>Observaciones</h2>

                    <p>{{$clinico->observaciones}}</p>
                    
                </div>

                    @empty
                    
                        <div>

                            <form action="{{route('store.clinicos', $paciente->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="paciente_id" value="{{$paciente->id}}">

                                <label for="">Fecha de inicio</label>
                                <input type="date" name="fecha_inicio">

                                <label for="">Diagnostico</label>
                                <input type="text" name="diagnostico">

                                <label for="">Tratamiento</label>
                                <input type="text" name="tratamiento">
                                
                                <label for="">Observaciones</label>
                                <textarea name="observaciones"  cols="30" rows="10"></textarea>

                                <input type="submit" value="Guardar">
                            </form>

                        </div>
                    @endforelse

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

            <div id="sesiones-{{$paciente->id}}" class="tab-content" style="display: none;">
                
                <div class="sesiones-header" style="display: flex; justify-content: flex-end; margin-bottom: 15px;">
                    <button type="button" class="btn-nueva-sesion" onclick="mostrarFormularioSesion('{{$paciente->id}}')">Nueva sesión</button>
                </div>

                <div class="sesiones-grid" style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 20px;">
                    
                    <div class="lista-sesiones">
                        <h3>Sesiones</h3>
                        
                        @forelse ($sesiones as $sesion)
                                
                                    <div>
                                        <h2>N°</h2>
                                    </div>

                                    <div>
                                        <label for="">Duración</label>
                                        <p>{{$sesion->duracion}}</p>

                                        <label for=""></label>
                                        <p>{{$sesion->fecha_sesion}}</p>

                                    </div>

                                @empty
                                
                                    <div>
                                        <h2>Aún no hay sesiones registradas</h2>
                                    </div>
                                
                                @endforelse

                    <div class="detalle-sesion-container">
                        
                            <div id="detalle-visual-{{$paciente->id}}" style="border: 1px solid #000; padding: 15px; display: block;">
                                <h3>Datos de la sesión</h3>

                                @foreach ($sesiones as $sesion)
                                    
                                
                                <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                                    <div>
                                        <label for="">Duración</label>
                                        <p>{{$sesion->duracion}}</p>
                                    </div>
                                    <div>
                                        <label for="">Fecha sesión</label>
                                        <p>{{$sesion->fecha_sesion}}</p>
                                    </div>
                                </div>
                                
                                <div style="border: 1px solid #000; padding: 10px; min-height: 150px;">
                                    <h4>Notas</h4>
                                    <p>{{$sesion->notas}}</p>
                                    
                                </div>
                                @endforeach
                            </div>

                            @foreach ($pacientes as $paciente)
                                
                                <div id="form-sesion-{{$paciente->id}}" style="border: 1px solid #000; padding: 15px; display: none;">
                                    <h3>Nueva Sesión para: {{$paciente->nombre}}</h3>
                                
                                    <form action="{{route('sesion.store')}}" method="POST">
                                        @csrf

                                        @foreach ($psicologos as $psicologo)
                                            <input type="hidden" name="psicologo_id" value="{{$psicologo->id}}">
                                        @endforeach
                                        
                                        <input type="hidden" name="paciente_id" value="{{$paciente->id}}">

                                        <label for="">Fecha sesión</label>
                                        <input type="date" name="fecha_sesion">

                                        <label for="">Duración</label>
                                        <input type="number" step="1" max="120" name="duracion">

                                        <label for="">Notas</label>
                                        <input type="text" name="notas">

                                        <button type="submit" class="btn-guardar-sesion">Guardar Sesión</button>
                                        <button type="button" onclick="cancelarNuevaSesion('{{$paciente->id}}')">Cancelar</button>

                                    </form>
                                </div>

                            @endforeach

                    </div>
                </div>

                 <div class="modal-actions" style="margin-top: 20px;">
                    <button type="button" class="closeModalBtn btn-cerrar-modal">Cerrar</button>
                </div>
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


<script>
    // --- LÓGICA DE MODALES EXISTENTE ---
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
                // Reiniciar a la pestaña general al abrir
                // Esto asegura que siempre inicie en "Información General"
                const tabLinks = modal.querySelectorAll('.tab-link');
                if(tabLinks.length > 0) tabLinks[0].click();
            }
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('dialog');
            if (modal) modal.close();
        });
    });

    openEditButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const editModalId = button.dataset.editModalId;
            const editModal = document.getElementById(editModalId);
            if (editModal) editModal.showModal();
        });
    });

    closeEditButtons.forEach(button => {
        button.addEventListener('click', () => {
            const editModal = button.closest('dialog');
            if (editModal) editModal.close();
        });
    });

    // --- NUEVA LÓGICA PARA PESTAÑAS Y SESIONES ---

    // Función para cambiar pestañas (General vs Historial)
    function openTab(evt, tabName) {
        // Obtener el modal actual buscando hacia arriba desde el botón clickeado
        const modal = evt.target.closest('.modal-content'); 
        
        // Ocultar todo el contenido de pestañas dentro de este modal específico
        const tabContents = modal.querySelectorAll('.tab-content');
        tabContents.forEach(tab => tab.style.display = "none");

        // Quitar clase active de todos los botones de este modal
        const tabLinks = modal.querySelectorAll('.tab-link');
        tabLinks.forEach(link => {
            link.style.borderBottom = "none";
            link.style.fontWeight = "normal";
        });

        // Mostrar la pestaña actual y activar botón
        const activeTab = document.getElementById(tabName);
        if(activeTab) activeTab.style.display = "block";
        
        evt.currentTarget.style.borderBottom = "2px solid black";
        evt.currentTarget.style.fontWeight = "bold";
    }

    // Función para mostrar el formulario de nueva sesión
    function mostrarFormularioSesion(idPaciente) {
        document.getElementById('detalle-visual-' + idPaciente).style.display = 'none';
        document.getElementById('form-sesion-' + idPaciente).style.display = 'block';
    }

    // Función para cancelar y volver a ver detalles
    function cancelarNuevaSesion(idPaciente) {
        document.getElementById('form-sesion-' + idPaciente).style.display = 'none';
        // Aquí podrías poner lógica para mostrar el último detalle visto o dejarlo vacío
        document.getElementById('detalle-visual-' + idPaciente).style.display = 'block';
    }

    // Función para simular ver detalles de una sesión de la lista
    function mostrarDetalleSesion(idPaciente, idSesion) {
        document.getElementById('form-sesion-' + idPaciente).style.display = 'none';
        document.getElementById('detalle-visual-' + idPaciente).style.display = 'block';
        // Aquí iría tu lógica AJAX o JS para cargar los datos reales de esa sesión específica
        console.log("Cargando sesión " + idSesion + " del paciente " + idPaciente);
    }
</script>

@endsection