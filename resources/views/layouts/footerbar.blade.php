<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iNeedHelp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        #footerbar{
            padding: 0.5em 0 0.5em 0;
            font-size: 20px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-style: oblique;
            font-weight: bold;
            margin-top:10px;
            
        }
        #footerbar .taskbar-left li{
            list-style-type: none;
            margin-left: 2em;
            

        }
        a.nav-link {
            text-decoration: none;
            color: black;
        }
        #footerbar .taskbar-right li{
            list-style-type: none;
            margin-right: 2em;
        }
        #footerbar .taskbar-left , .taskbar-right{
            margin: 0em;
            display: flex;
            flex-direction: row;
        }

        #footerbar ul {
            padding: 0em;
        }
    </style>
</head>
<footer class="footer">
    <nav id="footerbar" class="footerbar footerbar-light bg-light">
        <ul class="taskbar-left">
            <li class="nav-item">
                <p class="text-muted mt-4" >© LBAW2153 2021  </p>
            </li>
        </ul>
    
        <ul class="taskbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/faq">FAQ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
        </ul>
    
        </nav>

    
</footer>
</html>