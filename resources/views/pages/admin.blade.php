<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    </head>

    <body>


        <style>
            .wrapper {
                display: flex;
                width: 100%;
                align-items: stretch;
            }

            .wrapper {
                display: flex;
                align-items: stretch;
            }

            #sidebar.active {
                margin-left: -250px;
            }

            #sidebar {
                min-width: 250px;
                max-width: 250px;
                min-height: 100vh;
            }

            a[data-toggle="collapse"] {
                position: relative;
            }

            .dropdown-toggle::after {
                display: block;
                position: absolute;
                top: 50%;
                right: 20px;
                transform: translateY(-50%);
            }

            @media (max-width: 768px) {
                #sidebar {
                    margin-left: -250px;
                }

                #sidebar.active {
                    margin-left: 0;
                }
            }

            @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";


            body {
                font-family: 'Poppins', sans-serif;
                background: #fafafa;
            }

            p {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1em;
                font-weight: 300;
                line-height: 1.7em;
                color: #999;
            }

            a,
            a:hover,
            a:focus {
                color: inherit;
                text-decoration: none;
                transition: all 0.3s;
            }

            #sidebar {
                /* don't forget to add all the previously mentioned styles here too */
                background: #7386D5;
                color: #fff;
                transition: all 0.3s;
            }

            #sidebar .sidebar-header {
                padding: 20px;
                background: #6d7fcc;
            }

            #sidebar ul.components {
                padding: 20px 0;
                border-bottom: 1px solid #47748b;
            }

            #sidebar ul p {
                color: #fff;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
            }

            #sidebar ul li a:hover {
                color: #7386D5;
                background: #fff;
            }

            #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                background: #6d7fcc;
            }

            ul ul a {
                font-size: 0.9em !important;
                padding-left: 30px !important;
                background: #6d7fcc;
            }

            #content {
                display: flex;
                flex-grow: 1;
                justify-content: center;
                align-items: center;
            }

        </style>
        <script>
            $(document).ready(function() {

                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                });

            });
        </script>


        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Administrator Panel</h3>
                </div>

                <ul class="list-unstyled components">
                    {{-- <p>Dummy Heading</p> --}}
                    {{-- <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#">Home 1</a>
                            </li>
                            <li>
                                <a href="#">Home 2</a>
                            </li>
                            <li>
                                <a href="#">Home 3</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li>
                        <a href="#">Users</a>
                    </li>
                    <li>
                        <a href="#">Questions</a>
                    </li>
                    <li>
                        <a href="#">Tags</a>
                    </li>
                    {{-- <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Portfolio</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li> --}}
                </ul>
            </nav>
            <div id="content">
                {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                        </button>

                    </div>
                </nav> --}}
                <div>
                    @if ($users->count())
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Banned</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }}</th>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>{{ $user->is_blocked ? 'True' : 'False' }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->is_blocked)
                                                <form action="{{ route('changeBlock', $user->id)}}" method="post">
                                                @csrf

                                                    <button class="btn btn-warning" type="submit"><i class='bi bi-unlock-fill'></i></button>
                                                </form>

                                            @else

                                                <form action="{{ route('changeBlock', $user->id)}}" method="post">
                                                @csrf

                                                    <button class="btn btn-warning" type="submit"><i class='bi bi-lock-fill'></i></button>
                                                </form>

                                            @endif

                                            {{-- <form action="" method="post">

                                            </form> --}}
                                        </td>
                                        <td>

                                            <form action="{{ route('deleteUser', $user->id)}}" method="post">
                                                @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                        


                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                                {{ $users->links() }}
                            </div>
                        </div>
                    @else
                        <p>No Users available yet</p>
                    @endif


                </div>

            </div>
        </div>
    </body>

</html>
