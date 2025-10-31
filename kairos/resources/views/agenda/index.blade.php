@extends('layouts.app')

@section('content')

@include('layouts._partials.nav')

    <div style="border: solid 1px">
        <button id="openModalBtn">Horarios</button>
        
        <dialog id="myModal">

        <div style="border: solid 1px">
        
            <h2>Configurar horarios de atención</h2>

            <div style="border: solid 1px">
                <p>Aquí irá un for que mostrará cada día de la semana y respectiva configuración</p>
            </div>
        
        </div>
        
        <button>Guardar</button>
        <form action="" method="dialog">
            <button>Cerrar</button>
        </form>

        </dialog>    

        <div style="border: solid 1px">
            <h1>Itinerario</h1>

            <div style="border: solid 1px">
                <p>Aquí va a ir el calendario</p>
            </div>

        </div>

        <div style="border: solid 1px">
            <h2>Próximas sesiones</h2>

            <div style="border: solid 1px">

                <p>Aquí irá un forelse con todas las sesiones</p>

            </div>

            <div style="border: solid 1px">

                <h2>Horarios de atención</h2>

                <p>Aquí irá un forelse con cada uno de los horarios por día</p>

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