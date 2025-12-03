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

            <button type="button" class="openModalBtn btn-mostrar" data-modal-id="modal-{{$paciente->id}}">
                Mostrar Información
            </button>

            <dialog id="modal-{{$paciente->id}}" class="modal-paciente modal-con-tabs">
                
                <div class="modal-content">

                    <div class="modal-header-tabs">
                        <h2 class="modal-titulo">{{$paciente->nombre}}</h2>
                        
                        <div class="tabs-container">
                            <button type="button" class="tab-button active" onclick="openTab(event, 'general-{{$paciente->id}}')">
                                <span class="tab-icon">📋</span>
                                <span class="tab-text">Información General</span>
                            </button>
                            <button type="button" class="tab-button" onclick="openTab(event, 'sesiones-{{$paciente->id}}')">
                                <span class="tab-icon">📅</span>
                                <span class="tab-text">Historial de Sesiones</span>
                            </button>
                        </div>
                    </div>

                    <div class="tabs-content-wrapper">
                        
                        <!-- TAB 1: INFORMACIÓN GENERAL -->
                        <div id="general-{{$paciente->id}}" class="tab-panel active">
                            
                            <div class="datos-section">
                                <h3 class="section-title">Datos Personales</h3>
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
                                        <label>Teléfono</label>
                                        <p>{{$paciente->telefono}}</p>
                                    </div>
                                    <div class="dato-item">
                                        <label>Correo electrónico</label>
                                        <p>{{$paciente->correo}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="datos-section">
                                <h3 class="section-title">Datos Clínicos</h3>
                                
                                @forelse ($clinicos as $clinico)
                                    
                                    <div class="datos-grid">
                                        <div class="dato-item">
                                            <label>Fecha de inicio</label>
                                            <p>{{$clinico->fecha_inicio}}</p>
                                        </div>

                                        <div class="dato-item">
                                            <label>Diagnóstico</label>
                                            <p>{{$clinico->diagnostico}}</p>
                                        </div>

                                        <div class="dato-item">
                                            <label>Tratamiento</label>
                                            <p>{{$clinico->tratamiento}}</p>
                                        </div>
                                    </div>

                                    <div class="observaciones-section">
                                        <h4 class="subsection-title">Observaciones</h4>
                                        <div class="observaciones-content">
                                            <p>{{$clinico->observaciones}}</p>
                                        </div>
                                    </div>

                                @empty
                                
                                    <div class="clinicos-empty-state">
                                        <p class="empty-message">No hay datos clínicos registrados</p>
                                        <button type="button" class="btn-agregar-clinicos" onclick="mostrarFormClinico('{{$paciente->id}}')">
                                            Agregar datos clínicos
                                        </button>
                                    </div>

                                    <div id="form-clinico-{{$paciente->id}}" class="form-clinicos-wrapper" style="display: none;">
                                        <form action="{{route('store.clinicos', $paciente->id)}}" method="POST" class="form-clinicos">
                                            @csrf
                                            <input type="hidden" name="paciente_id" value="{{$paciente->id}}">

                                            <div class="form-group">
                                                <label>Fecha de inicio</label>
                                                <input type="date" name="fecha_inicio">
                                            </div>

                                            <div class="form-group">
                                                <label>Diagnóstico</label>
                                                <input type="text" name="diagnostico" placeholder="Ingrese el diagnóstico">
                                            </div>

                                            <div class="form-group">
                                                <label>Tratamiento</label>
                                                <input type="text" name="tratamiento" placeholder="Ingrese el tratamiento">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Observaciones</label>
                                                <textarea name="observaciones" rows="6" placeholder="Observaciones adicionales..."></textarea>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn-secundario" onclick="ocultarFormClinico('{{$paciente->id}}')">Cancelar</button>
                                                <button type="submit" class="btn-primario">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                @endforelse
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="closeModalBtn btn-secundario">Cerrar</button>
                                <button type="button" class="openEditModalBtn btn-primario" data-edit-modal-id="editModal-{{$paciente->id}}">Modificar Paciente</button>
                                <form action="{{route('pacientes.eliminar', $paciente->id)}}" method="POST" style="display: inline;">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>

                        <!-- TAB 2: HISTORIAL DE SESIONES -->
                        <div id="sesiones-{{$paciente->id}}" class="tab-panel">
                            
                            <div class="sesiones-container">
                                
                                <div class="sesiones-sidebar">
                                    <div class="sidebar-header">
                                        <h3 class="sidebar-title">Lista de Sesiones</h3>
                                        <button type="button" class="btn-nuevo-small" onclick="mostrarFormularioSesion('{{$paciente->id}}')">
                                            + Nueva
                                        </button>
                                    </div>
                                    
                                    <div class="sesiones-lista">
                                        @forelse ($sesiones as $index => $sesion)
                                            
                                            <div class="sesion-card" onclick="mostrarDetalleSesion('{{$paciente->id}}', '{{$sesion->id}}')">
                                                <div class="sesion-badge">{{$index + 1}}</div>
                                                <div class="sesion-preview">
                                                    <p class="sesion-fecha">{{$sesion->fecha_sesion}}</p>
                                                    <p class="sesion-duracion">{{$sesion->duracion}} min</p>
                                                </div>
                                            </div>

                                        @empty
                                        
                                            <div class="sesiones-lista-empty">
                                                <p>No hay sesiones registradas</p>
                                            </div>
                                        
                                        @endforelse
                                    </div>
                                </div>

                                <div class="sesiones-main">
                                    
                                    <div id="detalle-sesion-{{$paciente->id}}" class="sesion-detalle-view">
                                        
                                        @forelse ($sesiones as $sesion)
                                            
                                            <div class="detalle-header">
                                                <h3 class="detalle-titulo">Detalles de la Sesión</h3>
                                            </div>

                                            <div class="detalle-info-grid">
                                                <div class="info-box">
                                                    <label>Fecha</label>
                                                    <p>{{$sesion->fecha_sesion}}</p>
                                                </div>
                                                <div class="info-box">
                                                    <label>Duración</label>
                                                    <p>{{$sesion->duracion}} minutos</p>
                                                </div>
                                            </div>
                                            
                                            <div class="detalle-notas-section">
                                                <h4 class="notas-titulo">Notas de la Sesión</h4>
                                                <div class="notas-content">
                                                    <p>{{$sesion->notas}}</p>
                                                </div>
                                            </div>

                                        @empty
                                        
                                            <div class="sesion-detalle-empty">
                                                <div class="empty-icon">📝</div>
                                                <p>Selecciona una sesión para ver sus detalles</p>
                                            </div>
                                        
                                        @endforelse
                                    </div>

                                    <div id="form-sesion-{{$paciente->id}}" class="form-sesion-view" style="display: none;">
                                        
                                        <div class="form-header">
                                            <h3 class="form-titulo">Nueva Sesión - {{$paciente->nombre}}</h3>
                                        </div>
                                    
                                        <form action="{{route('sesion.store')}}" method="POST" class="form-sesion">
                                            @csrf

                                            @foreach ($psicologos as $psicologo)
                                                <input type="hidden" name="psicologo_id" value="{{$psicologo->id}}">
                                            @endforeach
                                            
                                            <input type="hidden" name="paciente_id" value="{{$paciente->id}}">

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label>Fecha de la sesión</label>
                                                    <input type="date" name="fecha_sesion">
                                                </div>

                                                <div class="form-group">
                                                    <label>Duración (minutos)</label>
                                                    <input type="number" step="1" max="120" name="duracion" placeholder="60">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Notas de la sesión</label>
                                                <textarea name="notas" rows="8" placeholder="Escribe las notas de la sesión..."></textarea>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn-secundario" onclick="cancelarNuevaSesion('{{$paciente->id}}')">Cancelar</button>
                                                <button type="submit" class="btn-primario">Guardar Sesión</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="closeModalBtn btn-secundario">Cerrar</button>
                            </div>
                        </div>

                    </div>

                </div>

            </dialog>

            <dialog id="editModal-{{$paciente->id}}" class="modal-paciente modal-edit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Editar Paciente</h2>
                        <p class="modal-subtitle">{{$paciente->nombre}}</p>
                    </div>
                    
                    <form action="{{route('pacientes.update', $paciente->id)}}" method="POST" class="form-edit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>Nombre completo</label>
                            <input type="text" name="nombre" value="{{$paciente->nombre}}" placeholder="Nombre completo">
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label>Edad</label>
                                <input type="number" name="edad" value="{{$paciente->edad}}">
                            </div>
                            
                            <div class="form-group">
                                <label>Género</label>
                                <select name="genero">
                                    <option value="">Seleccionar</option>
                                    <option value="Masculino" @selected($paciente->genero == 'Masculino')>Masculino</option>
                                    <option value="Femenino" @selected($paciente->genero == 'Femenino')>Femenino</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" value="{{$paciente->telefono}}" placeholder="Teléfono de contacto">
                        </div>
                        
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" name="correo" value="{{$paciente->correo}}" placeholder="correo@ejemplo.com">
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="closeEditModalBtn btn-secundario">Cancelar</button>
                            <button type="submit" class="btn-primario">Guardar Cambios</button>
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
                const firstTab = modal.querySelector('.tab-button');
                if(firstTab) firstTab.click();
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

    function openTab(evt, tabName) {
        const modal = evt.target.closest('.modal-content'); 
        
        const tabPanels = modal.querySelectorAll('.tab-panel');
        tabPanels.forEach(panel => panel.classList.remove('active'));

        const tabButtons = modal.querySelectorAll('.tab-button');
        tabButtons.forEach(btn => btn.classList.remove('active'));

        const activePanel = document.getElementById(tabName);
        if(activePanel) activePanel.classList.add('active');
        
        evt.currentTarget.classList.add('active');
    }

    function mostrarFormClinico(idPaciente) {
        document.getElementById('form-clinico-' + idPaciente).style.display = 'block';
    }

    function ocultarFormClinico(idPaciente) {
        document.getElementById('form-clinico-' + idPaciente).style.display = 'none';
    }

    function mostrarFormularioSesion(idPaciente) {
        document.getElementById('detalle-sesion-' + idPaciente).style.display = 'none';
        document.getElementById('form-sesion-' + idPaciente).style.display = 'block';
    }

    function cancelarNuevaSesion(idPaciente) {
        document.getElementById('form-sesion-' + idPaciente).style.display = 'none';
        document.getElementById('detalle-sesion-' + idPaciente).style.display = 'block';
    }

    function mostrarDetalleSesion(idPaciente, idSesion) {
        document.getElementById('form-sesion-' + idPaciente).style.display = 'none';
        document.getElementById('detalle-sesion-' + idPaciente).style.display = 'block';
        console.log("Cargando sesión " + idSesion + " del paciente " + idPaciente);
    }
</script>

@endsection