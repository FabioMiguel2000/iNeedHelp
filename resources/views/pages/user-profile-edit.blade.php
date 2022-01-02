@extends('layouts.navbar')

@section('content')

    <!DOCTYPE html>

    <html lang="{{ app()->getLocale() }}">

    <head>
        @if (Auth::check())
            <title>{{ $user->username }} Profile</title>
        @endif
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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

            .user-profile-picture-and-header-info {
                display: flex;
                flex-direction: row;
                margin: 15px 0px 0px 50px;
                position: relative;
            }

            .user-info {
                display: flex;
                flex-direction: row;
            }

            .user-profile-picture {
                margin: 20px 0px 0px 0px;
            }

            .user-profile-picture img {
                height: 250px;
                width: 250px;
                border-radius: 125px;
            }

            .user-header-info {
                margin: 15px 0px 0px 25px;
            }

            .user-fullname input {
                width: 275px;
            }

            .user-description {
                margin: 30px 0px 0px 50px;
            }

            .bio-textarea {
                height: 140px;
                width: 400px;
                resize: none;
            }

            .user-status select {
                width: 150px;
                text-align: center;
            }

            .user-location {
                margin: 35px 0px 0px 0px;
            }

            .save-btn {
                margin: -50px 0px 0px 300px;
            }

            .save-btn input {
                width: 100px;
            }

            .edit-circle-container {
                width: 50px;
                height: 50px;
                border-radius: 25px;
                background-color: lightcyan;
                z-index: 1;
                position: absolute;
                margin: 230px 0px 0px 230px;
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

            #edit-form {
                display: flex;
                flex-direction: row;
            }

            .main-container {
                height: 73vh;
            }

        </style>
    </head>

    <body>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <div class="path-on-user-page">
            <p style="display: none"><a href="{{ route('home') }}">Home</a> -> Users -> {{ $user->username }}</p>
        </div>
        <div class="main-container">
            <div class="user-info">
                {{-- <div class="edit-circle-container">
                    <div class="icon">
                        <a href="#"><input class="circle-btn" id="changeProfileImageBtn" type="submit" value="" ><i
                                class="bi bi-pencil-fill"></i></a>
                    </div>
                </div> --}}
                <script>
                    $(document).on('click', '#changeProfileImageBtn', function() {
                        $('#changeProfileImageInput').click()
                    })
                    $(document).on('click', '#profile-icon', function() {
                        $('#changeProfileImageInput').click()
                    })

                    function changeImage(value){
                        let file = document.getElementById("changeProfileImageInput").files[0]; 
                        document.getElementById("profileImage").src=URL.createObjectURL(file);
                    }
                </script>
                <form id="edit-form" enctype="multipart/form-data" action="{{ route('user-update', ['username' => $user->username]) }}" method="post">
                    @csrf
                    <input type="file" name="profileImage" id="changeProfileImageInput" onchange="changeImage(this.value)" style="display: none">
                    <div class="user-profile-picture-and-header-info" id="profile-icon" style="cursor: pointer;">
                        <div class="user-profile-picture">
                            <div class="media">
                                <div class="media-bottom">
                                    @if ($user->getProfileImage()== null)
                                    <img class="media-object" id="profileImage" src="{{asset('assets/profileImages/defaultProfileImage.webp')}}" alt="Profile Picture">
                                @else
                                    <img class="media-object" id="profileImage" src="{{(asset($user->getProfileImage()))}}" alt="Profile Picture">
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="user-header-info">
                            <div class="media-body">
                                <p>Username</p>
                                <h4 class="media-heading user-name">{{ $user->username }}</h4>
                                <br>
                                <p>Full Name</p>
                                <p class="user-fullname"><input name="full-name" class="textbox" type="text"
                                        value="{{ $user->full_name }}" maxlength="100"></p>
                                <br>
                                <p>Status</p>
                                <p class="user-status">
                                    <select class="user-status-dropdown" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="idle">Idle</option>
                                        <option value="doNotDisturb">Do Not Disturb</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="user-description">
                        <div class="user-bio">
                            <p>Bio</p>
                            <p><textarea name="bio" class="bio-textarea" maxlength="300">{{ $user->bio }}</textarea>
                            </p>
                        </div>
                        <div class="user-location">
                            <p>Location</p>
                            <p><input name="location" class="textbox" type="text" value="{{ $user->location }}"
                                    maxlength="100"></p>
                        </div>
                        <div class="save-btn">
                            <input type="submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts.footerbar')
    </body>

    </html>
@endsection
