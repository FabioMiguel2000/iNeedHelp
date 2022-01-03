@extends('layouts.navbar')

@section('content')

<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
    <head>
        <title>iNeedHelp</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta charset="utf-8">
        <style>
            .header-container {
                margin: 30px 0px 40px 100px;
            }

            .main-container {
                display: flex;
                flex-direction: row;
            }
            
            .question-results-container {
                display: flex;
                flex-direction: column;
                margin: 10px 0px 0px 100px;
            }

            .question-list-container a {
                text-decoration: none;
                color: black;
                font-size: 20px;
            }

            .vertical-divider {
                margin-left: 50px;
                margin-right:50px;
                width:1px;
                height: inherit;
                border-left:2px solid gray;
            }
            .main-container{
                min-height: 62vh;
            }
        </style>
    </head>
    <body>
        <div class="header-container">
            <h2>Search Results</h2>
        </div>

        <div class="main-container">
            <div class="question-results-container">
                <h3 style="margin-bottom: 20px">Questions:</h3>
                @if($questions->isNotEmpty())
                    @foreach ($questions as $question)
                        <div class="question-list-container">
                            <p><a href="{{ '/questions/' . $question->id }}">{{$question->title}}</a></p>
                        </div>
                    @endforeach
                @else
                    <div class="nothing-found-container">
                        <p>Sorry... We found nothing :(</p>
                    </div>
                @endif
            </div>

            <div class="vertical-divider"></div>

            <div class="user-results-container">
                <h3 style="margin-bottom: 20px">Users:</h3>
                @if($users->isNotEmpty())
                    @foreach ($users as $user)
                        <div class="question-list-container">
                            <p><a href="{{ '/user/' . $user->username }}">{{$user->username}}</a></p>
                        </div>
                    @endforeach
                @else
                    <div class="nothing-found-container">
                        <p>Sorry... We found nothing :(</p>
                    </div>
                @endif
            </div>

        </div>
    </body>
</html>






@include('layouts.footerbar')



@endsection