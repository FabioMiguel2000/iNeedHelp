@extends('layouts.navbar')

@section('content')

    <style>
        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 2em;
            margin: 1rem 0;
        }

        .about-content {
            /*width: 70%;*/
            margin: auto;
            background-color: bisque;
            border-radius: 20px;
            padding: 2rem 3rem;
            font-weight: bold;
        }

        .content-wrapper {
            min-height: 68vh;
        }

        .join-us-btn {
            background-color: rgb(251, 124, 21);
            border-radius: 10px;
            padding: 0.5em 0.5em 0.5em 0.5em;
            text-align: center;
        }

        @media (min-width: 768px) {
            .join-us-btn {
                width: 20%;
            }
        }

        @media (min-width: 1024px) {
            .join-us-btn {
                width: 10%;
            }
        }

        .join-us-btn:hover {
            background-color: rgb(249, 112, 0);
            cursor: pointer;
        }

        .join-us-btn a {
            text-decoration: none;
            color: white;

        }

        .join-us-btn a:hover {
            color: white;
        }
    </style>

    <div class="container">
        <div class="title">
            <img src="{{ asset('assets/logo.png') }}" style="height: 200px; width:200px;" alt="logo">
            <h1>
                Welcome to iNeedHelp
            </h1>
        </div>
        <div class="about-content">
            <p>
                The iNeedHelp project is the development of a web-based information system for managing threads of
                questions and their respective answers, users, and their information. This is a tool that can be used by
                anyone, but it is focused on students, teachers, investigators as well as all types of academics
            </p>
            <div class="join-us-btn">
                <a href="{{route('register')}}">Join us</a>
            </div>
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
