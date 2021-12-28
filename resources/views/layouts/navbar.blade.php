<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iNeedHelp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        #navbar {
            padding: 1em 1em 1.5em 1em;
            font-size: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-style: oblique;
            font-weight: bold;
        }

        #navbar .taskbar-left li {
            list-style-type: none;
            /*margin-left: 2em;*/
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
            /*margin-right: 2em;*/
        }

        #navbar .taskbar-left, .taskbar-right, .taskbar-center {
            margin: 0em;
            display: flex;
            flex-direction: row;
        }

        #navbar ul {
            padding: 0em;
        }
    </style>
</head>
<body>
<nav id="navbar" class="navbar navbar-light">
    <ul class="taskbar-left">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('questions') }}">Questions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('new-question') }}">New Question</a>
        </li>
        <li>
            <a class="nav-link" href="/tags">Tags</a>
        </li>

    </ul>

    <ul class="taskbar-center">
        <p>Search placeholder</p>
    </ul>

    <ul class="taskbar-right">
        @if(Auth::check())
            <li class="nav-item">
                <a class="nav-link" href="{{ '/user/'.auth()->user()->username }}">{{auth()->user()->username}}</a>
            </li>
            <li class="nav-item">
                {{-- <a class="nav-link" href="">Logout</a> --}}
                <form action="{{ route('logout')}}" method="post">
                    @csrf
                    {{-- <a class="nav-link" href="">Logout</a> --}}
                    <button type="submit" class="logout">Logout</button>
                    {{-- <a href="" class="nav-link" onclick="this.parentNode.submit()">Logout</a> --}}
                </form>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
        @endif
    </ul>
</nav>
<hr style="margin: 0">

@yield('content')

</body>
</html>
