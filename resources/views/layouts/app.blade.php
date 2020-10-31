<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Modelo de Projeto') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    
    {{-- Css geral bootstrap --}}
    <link rel="stylesheet" href="{{url('assets/geral/css/bootstrap.min.css')}}">
    {{-- Css font Awesome --}}
    <link rel="stylesheet" href="{{url('assets/geral/fontawesome/css/all.css')}}">
    {{-- Icon --}}
    {{-- <link rel="icon" type="image/png" href="{{url('assets/sys/img/title.png')}}"> --}}
    {{-- Site css --}}
    <link rel="stylesheet" href="{{url('assets/sys/css/dashboard.css')}}">
</head>
<body>
    <div>
        <main>
            @yield('content')
        </main>
    </div>


    <script src="{{url('assets/geral/js/jquery.min.js')}}"></script>
    <script src="{{url('assets/geral/js/popper.min.js')}}"></script>
    <script src="{{url('assets/geral/js/bootstrap.min.js')}}"></script>
    
</body>
</html>
