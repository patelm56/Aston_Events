<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

     <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'signedIn' => Auth::check(),
            'user' => Auth::user()
        ]) !!};
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar navbar-default" style="background-color:white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                        @endauth
                            <li><a class="nav-link" href="{{ route('events.index') }}">Events</a></li>
                            @auth
                            <li><a class="nav-link" href="{{ route('events.create') }}">New Event</a></li>
                            <li><a class="nav-link" href="/events?popular=1">Popular Events</a></li>
                           @endauth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @auth
                                <a  class="dropdown-item" href="/events?by={{auth()->user()->name}}" title="see your events">My Events</a>
                                @endauth
                                <a class="dropdown-item" href="/events?past_events=1">Current Events</a>
                                <a class="dropdown-item" href="/events?upcoming_events=1">Future Events</a>
                                <a class="dropdown-item" href="/events/type/sport">Sports</a>
                                <a class="dropdown-item" href="/events/type/culture">Culture</a>
                                <a class="dropdown-item" href="/events/type/other">Others</a>


                            </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')

             <!-- Vue flash component -->
            <flash message="{{ session('flash') }}"></flash>

        </main>
    </div>
</body>
</html>
