@if ($message = Session::get('success'))
    
    <div class="message-success">
        <p>{{$message}}</p>
    </div>

@endif

@if ($message = Session::get('danger'))
    
    <div class="message-danger">
        <p>{{$message}}</p>
    </div>
@endif