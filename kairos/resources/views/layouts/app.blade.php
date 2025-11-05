<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kairos</title>

    @vite(['resources/css/app.css'])
</head>
<body>

    
    

    @vite(['resources/css/app.css'])

    <div class="message-container">
        @include('layouts._partials.messages')
    </div>

    @yield('content')
    
</body>
</html>