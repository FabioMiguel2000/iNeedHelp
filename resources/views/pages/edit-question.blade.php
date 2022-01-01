@extends('layouts.navbar')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>iNeedHelp</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            /* body {
                font-family: Arial, Helvetica, sans-serif;
                margin: 0;
            } */

            .new-question {
                padding: 50px;
                text-align: center;
                background-color: #474e5d;
                color: white;
            }

            #content {
                height: 100px;
            }

            .wrapper{
                min-height: 73vh;
            }

        </style>
    </head>

    <body>
        <br>
        <div class="wrapper">
            @if (Auth::check())
                <div class="new-question">
                    <h1>Edit Question</h1>
                    <p>Here you can edit your question's title, content and tags</p>
                </div>

                <form style="width:1000px; margin:auto" action="{{ route('question.update', $question) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="title">Question Title:</label>
                        <input name="title" type="text" id="title" class="form-control"
                            value="{{$question->title}}"
                            required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="content">Content</label>
                        <input name="content" type="text" id="content" class="form-control"
                            value="{{$question->content}}"
                            required>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="tags">Tags</label>
                        <input name="tags" type="text" id="tags" class="form-control"
                            placeholder="Insert Tags Related to question">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary mt-1">Update Question</button>
                    </div>
                </form>
            @else
                {{-- <div style="width:1000px;  margin:auto">
                In order to post questions first you have so be logged in.<br> 
                So, if you already have an account --> <a href="/login">Login</a><br>
                Otherwise you can click on <a href="/register">Register</a> to create an account.
            </div> --}}
            @endif

        </div>





        @include('layouts.footerbar')

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
                integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
                integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
        </script>
    </body>

    </html>

@endsection
