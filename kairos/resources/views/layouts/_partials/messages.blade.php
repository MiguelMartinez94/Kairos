@if ($message = Session::get('success'))
    
    <div style="background: green; color: white">

        <p>{{$message}}</p>

    </div>

@endif

@if ($message = Session::get('danger'))
    
    <div style="background: red; color: white">

        <p>{{$message}}</p>

    </div>

@endif