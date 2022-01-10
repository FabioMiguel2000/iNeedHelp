<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? config('app.name', 'iNeedHelp') }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    >

    <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>

    <style>
        #navbar {
            padding: 1rem 2rem;
            font-size: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-style: oblique;
            font-weight: bold;
        }

        #navbar .taskbar-left li {
            list-style-type: none;
        }

        a.nav-link {
            text-decoration: none;
            color: black;
        }

        .logout {
            padding: .5rem 1rem;
            background: none;
            border: none;
            text-decoration: none;
            font-size: 20px;
            font-style: oblique;
            font-weight: bold;
        }

        .logout:hover {
            color: #0a58ca;
        }

        #navbar .taskbar-right li {
            list-style-type: none;
        }

        #navbar .taskbar-left,
        .taskbar-right,
        .taskbar-center {
            margin: 0;
            display: flex;
            flex-direction: row;
        }

        #navbar ul {
            padding: 0;
        }

        .taskbar-center input {
            width: 250px;
        }

        .taskbar-center button {
            color: #0a58ca;
        }
    </style>
</head>

<body class="d-flex flex-column" style="min-height: 100vh">

<nav id="navbar" class="navbar navbar-light">
    <ul class="taskbar-left">
        <a href="{{ route('home') }}"><img src="{{ asset('assets/logo.png') }}" alt="logo" width="45px" height="45px"
                                           style="margin: 0 15px;"
                                           class="logo"></a>
        {{-- <li class="nav-item" class='homePage'>
            <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ route('questions') }}">Questions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('new-question') }}">Ask Question</a>
        </li>
        <li>
            <a class="nav-link" href="/tags">Tags</a>
        </li>

    </ul>

    <form class="taskbar-center" action="{{ route('search-result') }}">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-light btn-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>

    <ul class="taskbar-right">
        @if (Auth::check())
            @if (auth()->user()->isAdministrator())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('adminPage', 'users') }}">Admin Panel</a>
                </li>
            @else

            @endif
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ '/user/' . auth()->user()->username }}">{{ auth()->user()->username }}</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="logout">Logout</button>
                </form>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>

        @endif
    </ul>
</nav>
<hr style="margin: 0 0 1rem">

@if (session('success'))
    <div class="alert alert-success mx-4" role="alert">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mx-4" role="alert">
        {{ $errors->first() }}
    </div>

@endif

@yield('content')

</body>

</html>
