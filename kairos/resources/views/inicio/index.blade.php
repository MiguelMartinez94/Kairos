@extends('layouts.app')

@section('content')

    @include('layouts._partials.nav')


    <div class="dashboard-container">
    <div class="dashboard-grid">
        <div class="dashboard-card calendario-section">
            <h1>Itinerario</h1>
            <div class="calendario-placeholder">
                <p>Aquí va a ir el calendario</p>
            </div>
        </div>
        
        <div class="sesiones-sidebar">
            <div class="sesiones-card">
                <h2>Próximas sesiones</h2>
                <div class="sesiones-list">
                    <p>Aquí irá un forelse con todas las sesiones</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection