<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iNeedHelp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        #navbar{
            padding: 1.5em 0 1.5em 0;
            font-size: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-style: oblique;
            font-weight: bold;
            
            
        }
        #navbar .taskbar-left li{
            list-style-type: none;
            margin-left: 2em;
            

        }
        a.nav-link {
            text-decoration: none;
            color: black;
        }
        #navbar .taskbar-right li{
            list-style-type: none;
            margin-right: 2em;
        }
        #navbar .taskbar-left , .taskbar-right{
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
    <nav id="navbar" class="navbar navbar-light bg-light">
        <ul class="taskbar-left">
            <li class="nav-item">
                <a class="nav-link" href="" >Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Questions</a>
            </li class="nav-item">
            <li>
                <a class="nav-link" href="">Tags</a>
            </li>

        </ul>

        <ul class="taskbar-right">
            <li class="nav-item">
                <a class="nav-link" href="">Username</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Register</a>
            </li>

        </ul>

    </nav>
    @yield('content')
    
</body>
</html>