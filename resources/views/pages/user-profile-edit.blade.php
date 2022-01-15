@extends('layouts.navbar')

@section('content')

    @if (Auth::check())
        <title>{{ $user->username }} Profile</title>
    @endif
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

    <div class="path-on-user-page">
        <p style="display: none"><a href="{{ route('home') }}">Home</a> -> Users -> {{ $user->username }}</p>
    </div>

    <div class="main-container">
        <div class="user-info">

            <form id="edit-form" enctype="multipart/form-data"
                  action="{{ route('user-update', ['username' => $user->username]) }}" method="post">
                @csrf
                <input type="file" accept="image/*" name="profileImage" id="changeProfileImageInput"
                       onchange="changeImage(this.value)" style="display: none">
                <div class="user-profile-picture-and-header-info" id="profile-icon">
                    <div class="user-profile-picture" style="cursor: pointer;">
                        @if ($user->getProfileImage()== null)
                            <img class="media-object" id="profileImage"
                                 src="{{asset('assets/profileImages/defaultProfileImage.webp')}}"
                                 alt="Profile Picture">
                        @else
                            <img class="media-object" id="profileImage"
                                 src="{{(asset($user->getProfileImage()))}}" alt="Profile Picture">
                        @endif
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

            <div class="delete-account">
                <a href="{{route('user-delete', auth()->user()->username)}}"><input class="btn btn-danger"
                                                                                  id="deleteAccountBtn"
                                                                                  type="submit" value="Delete Account"></a>
            </div>

            <script>
                document.querySelector('.user-profile-picture').addEventListener('click', function () {
                    document.querySelector('#changeProfileImageInput').click()
                })

                function changeImage(value) {
                    // let file = document.getElementById("changeProfileImageInput").files[0];
                    document.getElementById("profileImage").src = URL.createObjectURL(value);
                }
            </script>
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
