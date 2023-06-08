<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <title>Головна сторінка</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>

<body class="text-center">
<div class="bg-image">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner text-left">
                <img src="{{ asset('img/logo.png') }}" style="height: 2vw;">
                <nav class="nav nav-masthead justify-content-center">
                    @if (Route::has('login'))
                        @auth
                            <a class="nav-link" href="{{ url('/dashboard') }}">Головна сторінка</a>
                            <a class="nav-link" href="{{ url('/lobbies') }}">Ігрові кімнати</a>
                        @else
                            <a class="nav-link" href="/login">Вхід</a>

                            @if (Route::has('register'))
                                <a class="nav-link" href="/register">Реєстрація</a>
                            @endif
                        @endauth
                    @endif
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading">Не знаєте, у що пограти?</h1>
            <p class="lead" style="color: #fff;">Монополія на тематику Львова!
                Тут ви знайдете поля, пов’язані з нашим містом, і круто проведете час!</p>
            <p class="lead">
                @if(Route::has('login'))
                    @auth
                        <a href="{{url('/dashboard')}}" class="btn btn-lg btn-primary">ГРАТИ!</a>
                    @else
                        <a href="{{url('/login')}}" class="btn btn-lg btn-primary">ГРАТИ!</a>
                    @endauth
                @endif
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">
                <p>© 2023 <a href="/">Monopoly</a>, developed by <a
                    href="https://github.com/kimmbl">Dmytro Denys</a>.</p>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://st77ackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</div>
</body>

</html>
