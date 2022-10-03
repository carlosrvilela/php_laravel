<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('/css/app.css') }}>
    <title>{{ $title }} - Controle de Séries</title>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>

        @auth
        <a href="{{ route('logout') }}">Sair</a>
        @endauth

        @guest
        <a href="{{ route('login') }}">Entrar</a>
        @endguest
    </div>
</nav>
<body>
    <div class="container">
        <h1>{{ $title }}</h1>

        @isset($successMessage)
        <div class="alert alert-success">
            {{$successMessage}}
        </div>
        @endisset

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{ $slot }}
    </div>
</body>
</html>
