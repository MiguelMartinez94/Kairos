@extends('layouts.app')

@section('content')

@include('layouts._partials.nav')

    <div class="agenda-container">
    <button id="openModalBtn" class="horarios-button">Horarios</button>
    
    <dialog id="myModal">
        <div class="modal-content">
            <h2>Configurar horarios de atención</h2>
            <div class="horarios-config">
                <p>Aquí irá un for que mostrará cada día de la semana</p>
            </div>
            <div class="modal-buttons">
                <button class="btn-guardar">Guardar</button>
                <form action="" method="dialog">
                    <button class="btn-cerrar">Cerrar</button>
                </form>
            </div>
        </div>
    </dialog>
    
    <div class="agenda-grid">
        <div class="agenda-card">
            <h1>Itinerario</h1>
            <div class="calendario-container">
                <p>Aquí va a ir el calendario</p>
            </div>
        </div>
        
        <div class="sidebar-agenda">
            <div class="agenda-card">
                <h2>Próximas sesiones</h2>
                <div class="sesiones-container">
                    <p>Aquí irá un forelse con todas las sesiones</p>
                </div>
            </div>
            
            <div class="agenda-card">
                <h2>Horarios de atención</h2>
                <div class="horarios-atencion-container">
                    <p>Aquí irá un forelse con cada uno de los horarios</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
                
        const modal = document.getElementById('myModal');
        const openBtn = document.getElementById('openModalBtn');


        const openModal = () => {
        modal.showModal(); 
        };


        openBtn.addEventListener('click', openModal);


    </script>
    
@endsection