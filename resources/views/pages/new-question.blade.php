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

            .title {
                /* padding: 50px; */
                /* text-align: center; */
                /* background-color: #474e5d; */
                /* color: white; */
                padding-bottom: 3em;
            }

            .wrapper{
                width: 70%;
                margin: auto;
                min-height: 73vh;
            }
            .parameter{
                margin-bottom: 2em;
            }
            .parameter p{
                font-size: 0.7em;
                margin-bottom: 0;
            }
            .parameter label{
                font-weight: bold;
            }
            #question-content{
                resize: none;
            }
            .parameter input, .parameter textarea{
                font-size: 0.8em;
            }
        </style>

    </head>

    <body>
        <br>
        <div class="wrapper">
            @if (Auth::check())
                <div class="title">
                    <h1>Ask a public question</h1>
                    <p>Here you can create your question</p>
                </div>

                <form style="margin:auto" action="{{ route('new-question') }}" method="post">
                    @csrf
                    <div class="parameter">
                        <label for="title">Question Title:</label>
                        <p>Be specific and imagine you’re asking a question to another person</p>
                        <input name="title" type="text" id="title" class="form-control"
                            placeholder="Try to insert a brief description of the problem while including the more relevant aspects"
                            required>
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="parameter">
                        <label for="content">Content</label>
                        <p>Include all the information someone would need to answer your question</p>
                        <textarea class="form-control" id="question-content" rows="10" name="content"></textarea>
                        {{-- <input name="content" type="text" id="content" class="form-control"
                            placeholder="Here you can explain in depth what is the problem.Try to include prints, pictures, graphs..."
                            required> --}}
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="parameter">
                        <label for="tags">Tags</label>
                        <p>Add up to 5 tags to describe what your question is about (note: insert tags separated by commas)</p>
                        <input name="tags" type="text" id="tags" class="form-control"
                            placeholder="e.g.(Java, VPN, exampleTag)">
                    </div>
                    <div style="margin-bottom: 4em;">
                        <button type="submit" class="btn btn-primary mt-1">Post Question</button>
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
