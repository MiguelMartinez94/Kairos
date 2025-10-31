@extends('layouts.app')

@section('content')

    @include('layouts._partials.nav')


    <div style="border: solid 1px">        
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
            
        </div>
    </div>
@endsection