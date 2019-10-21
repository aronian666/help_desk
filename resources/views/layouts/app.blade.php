<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-storage.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="{{ asset('js/app.js') }}" defer></script
        >
    <script rel="stylesheet" type="text/css" href="{{ asset('js/semantic.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
          apiKey: "AIzaSyCg9oK1P0-AioLqb0t_oN-82f57Evzt9e8",
          authDomain: "helpdesk-feba7.firebaseapp.com",
          databaseURL: "https://helpdesk-feba7.firebaseio.com",
          projectId: "helpdesk-feba7",
          storageBucket: "helpdesk-feba7.appspot.com",
          messagingSenderId: "814656955805",
          appId: "1:814656955805:web:57672a705f5df2413c3b74",
          measurementId: "G-R22TBQ7JN7"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
      </script>
</head>
<body>
    @if (Auth()->user())
        <div style="position:fixed;display:flex;flex-direction:column;top:0;bottom:0;left:0;width:250px;background:#1B1C1D;overflow-x:hidden;flex:1">
            <div class="ui borderless compact fluid inverted vertical menu">
                <div class="item">
                    <a href="{{ url("users/".Auth()->user()->id) }}" class="ui logo icon image">
                        <img src="{{ Auth()->user()->photo }}" alt="{{ Auth()->user()->name }}">
                    </a>
                    <a class="item" href="{{ url("users/".Auth()->user()->id) }}">
                        <b>{{ Auth()->user()->name }}</b>
                    </a>
                    <a class="item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>
                <div class="item">
                    <div class="header">Tickets</div>
                    <div class="menu">
                        <a href="{{ url("tickets") }}" class="item">Ver todos</a>
                        <a href="{{ url("tickets/create") }}" class="item">Crear</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                        </form>
                    </div>
                </div>
                <div class="item">
                    <div class="header">Usuarios</div>
                    <div class="menu">
                        <a href="{{ url('users') }}" class="item">Todos los usuarios</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div style="{{ Auth()->user() ? "margin-left: 250px; min-width: 550px;" : "" }} padding: 30px;" class="container">
            @yield('content')
    </div>
    
</body>
</html>
