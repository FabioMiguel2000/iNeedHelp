@extends('layouts.navbar')

@section('content')

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    @if(Auth::check())
    <title>{{$user->username}} Profile</title>
    @endif
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <style>
        .path-on-user-page {
            font-size: larger;
            margin: 25px 0px 0px 100px;
            display: flex;
            flex-direction: row;
        }

        .path-on-user-page a {
            color: black;
            text-decoration: none;
        }

        .edit-icon {
            margin-left: 75px;
        }

        .user-profile-picture-and-header-info {
            display: flex;
            flex-direction: row;
            margin: 15px 0px 0px 50px;
        }

        .user-profile-picture img {
            height: 250px;
            width: 250px;
            border-radius: 125px;
        }

        .user-header-info {
            margin: 15px 0px 0px 25px;
        }

        .user-description {
            margin: 15px 0px 0px 50px;
        }

        .main-container {
            display: flex;
            flex-direction: row;
            height: 68vh;
        }

        .vertical-divider {
            margin-left: 50px;
            margin-right:50px;
            width:1px;
            height: inherit;
            border-left:2px solid gray;
        }

        .user-recent-activity {
            margin: 30px 0px 0px 0px;
        }
    </style>
</head>

<body>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="path-on-user-page">
        <p style="display: none"><a href="{{ route('home')}}">Home</a> -> Users -> {{$user->username}}</p>
        @if($user->username == auth()->user()->username)
        <p class="edit-icon"><a href="{{ '/user/'.$user->username.'/edit' }}"><i class="bi bi-pencil-fill"></i></a></p>
        @endif  
    </div>
    <div class="main-container">
        <div class="user-info">
            <div class="user-profile-picture-and-header-info">
                <div class="user-profile-picture">
                    <div class="media">
                        <div class="media-bottom">
                            <img class="media-object" src="https://previews.123rf.com/images/kritchanut/kritchanut1406/kritchanut140600093/29213195-male-silhouette-avatar-profile-picture.jpg" alt="Profile Picture">
                        </div>
                    </div>
                </div>
                <div class="user-header-info">
                    <div class="media-body">
                        <h4 class="media-heading user-name">{{$user->username}}</h4>
                        <p class="user-fullname">{{$user->full_name}}</p>
                        <p class="user-status">{{$user->status}}</p>
                    </div>
                </div>
            </div>

            <div class="user-description">
                <div class="user-bio">
                    <p>{{$user->bio}}</p>
                </div>
                <div class="user-location">
                    <p>{{$user->location}}</p>
                </div>
            </div>
        </div>
        <div class="vertical-divider"></div>
        <div class="user-recent-activity">
            <h4>Recent Activity</h4>
        </div>
    </div>
    @include('layouts.footerbar')
</body>
</html>
@endsection