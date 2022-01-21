@extends('layouts.navbar')

@section('content')
    <style>
        /* .path-on-user-page {
            font-size: larger;
            margin: 25px 0px 0px 100px;
            display: flex;
            flex-direction: row;
        } */

        .path-on-user-page a {
            color: black;
            text-decoration: none;
        }

        .edit-icon {
            position: absolute;
            top: 45%;
            left: 16%;
        }

        .user-profile-picture-and-header-info {
            display: flex;
            flex-direction: row;
            justify-content: space-evenly;
            /* margin: 15px 0px 0px 50px; */
        }

        .user-profile-picture img {
            height: 200px;
            width: 200px;
            border-radius: 125px;
        }

        .user-header-info {
            margin: 15px 0px 0px 25px;
        }

        .user-description {
            margin: 5em 2em 0em 2em;
            display: flex;
            flex-direction: column;
            left: 10px;
        }

        .main-container {
            display: flex;
            flex-direction: row;
            min-height: 73vh;
        }

        .vertical-divider {
            margin-left: 50px;
            margin-right: 50px;
            width: 1px;
            height: inherit;
            border-left: 2px solid gray;
        }

        .user-recent-activity {
            margin: 0px 0px 0px 0px;
        }

        .question-list-ra-container {
            width: 600px;
            margin: 30px 0px 0px 0px;
        }

        .edit-circle-container {
            width: 50px;
            height: 50px;
            border-radius: 25px;
            background-color: lightcyan;
            z-index: 1;
            position: absolute;
            margin: 9.5em 0px 0px 12em;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .icon {
            position: relative;
            /* margin: 12px 0px 0px 0px; */
        }

        .icon i {
            position: absolute;
            margin: -37px 0px 0px 17px;
            z-index: 2;
        }

        .circle-btn {
            width: 50px;
            height: 50px;
            border-radius: 25px;
            background-color: transparent;
            z-index: 3;
            position: relative;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .container a {
            text-decoration: none;
            color: black;
        }
        div.user-info {
            min-height: 70vh;
            min-width: 80vh;
            border: grey 1px solid; 
            padding: 2em; 
            border-radius: 25px;
        }
        .user-bio{
            padding: 1em 2em 2em 2em;
            border-radius: 25px;
            border: #adb5bd 1px solid;
        }
    </style>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <div class="d-flex" style="margin: 2em 2em 2em 2em">
        <div class="user-info">
            @if (Auth::check() && $user->username == auth()->user()->username)
                <div class="edit-circle-container">
                    <div class="icon">
                        <a href="{{route('user-edit', auth()->user()->username)}}">
                            <input
                                class="circle-btn"
                                id="changeProfileImageBtn"
                                type="submit" value=""
                            >
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </div>
                </div>
            @endif
            <div class="user-profile-picture-and-header-info">
                <div class="user-profile-picture">
                    <div class="media">
                        <div class="media-bottom">
                            @if ($user->getProfileImage() == null)
                                <img class="media-object"
                                     src="{{ asset('assets/profileImages/defaultProfileImage.webp') }}"
                                     alt="Profile Picture">
                            @else
                                <img class="media-object" src="{{ asset($user->getProfileImage()) }}"
                                     alt="Profile Picture">
                            @endif
                            {{-- <img class="media-object" src="https://previews.123rf.com/images/kritchanut/kritchanut1406/kritchanut140600093/29213195-male-silhouette-avatar-profile-picture.jpg" alt="Profile Picture"> --}}
                        </div>
                    </div>
                </div>
                <div class="user-header-info" style="display: flex; ">
                    <div class="media-body" style="min-width: 200px; display:flex; justify-content:center; flex-direction: column; ">
                        <h4 class="media-heading user-name">{{ $user->username }}</h4>
                        <p class="user-fullname">Full Name: {{ $user->full_name }}</p>
                        <p class="user-status">Status: {{ $user->status }}</p>
                    </div>
                </div>
            </div>

            <div class="user-description">
                <div class="user-location">
                    <p>{{ $user->location }}</p>
                </div>
                <div class="user-bio">
                    <div style="display: flex; flex-direction:column; align-items:center;">
                        <p>User Bio</p>
                    </div>

                    <p>{{ $user->bio }}</p>
                </div>

            </div>
        </div>
        {{-- <div class="vertical-divider"></div> --}}

        <div class="container" style="margin-left: 10vh;">
            <ul class="nav nav-pills">
                <li class="list-group-item"><a class="active" data-toggle="tab" href="#home">Latest Questions</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#menu1">Latest Answers</a></li>
                <li class="list-group-item"><a data-toggle="tab" href="#menu3">Following</a></li>
            </ul>
            <br>

            <div class="tab-content">
                <div id="home" class="tab-pane active">
                    <div class="user-recent-activity">
                        <h3>Latest Questions</h3>
                        <div class="question-list-ra-container">
                            @if ($questions->count())
                                @include('partials.question_list',['questions'=>$questions] )
                            @else
                                <p>No questions</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>Answers given</h3>

                    <div class="list-group" style="max-width: 28rem">
                        @if ($answers->count())
                            @foreach($answers as $answer)

                                <a href="{{ route('question', ['id' => $answer->question->id]) }}"
                                   class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="me-2 text-truncate d-block">
                                            <h6 class="">{{ $answer->question->title }}</h6>
                                            <span>Answered: <i>{{$answer->content}}</i></span>
                                        </div>
                                        <div class="flex-shrink-0 text-muted">
                                            <span> {{$answer->question->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p>No Answers</p>
                        @endif
                    </div>
                    {{-- {{dd($answers)}} --}}
                </div>

                <div id="menu3" class="tab-pane fade">
                    <div class="list-group" style="max-width: 28rem">
                        <h3>Saved Questions</h3>
                        <div class="question-list-ra-container">
                            @if ($following->count())
                                @foreach($following as $follow)
                                    {{-- {{$follow->question->content}} --}}
                                    <a href="{{ route('question', ['id' => $follow->question->id]) }}"
                                       class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div class="me-2 text-truncate d-block">
                                                <h6 class="">{{ $follow->question->title }}</h6>
                                                <span>{{$follow->question->content}}</span>
                                            </div>
                                            <div class="flex-shrink-0 text-muted">
                                                <span> {{$follow->question->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <p>No Questions</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
