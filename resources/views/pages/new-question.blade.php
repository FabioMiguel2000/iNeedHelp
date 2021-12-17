@extends('layouts.navbar')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iNeedHelp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
        #content{
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="new-question">
        <h1>New Question</h1>
        <p>Lorem ipsum dolor sit amet</p>
    </div>

    <form style="width:1000px;  margin:auto"
        action="{{ route('new-question') }}"
        method="post"
    >
    @csrf
        <label for="question-title">Question Title:</label>
        <input 
            name="question-title"
            type="text"
            id="question-title"
            class="form-control" 
            placeholder="Try to insert a brief description of the problem while including the more relevant aspects"
            required
          >
        <label for="content">Content</label>
        <input 
            name="content"
            type="text"
            id="content"
            class="form-control"
            placeholder="Here you can explain in depth what is the problem.Try to include prints, pictures, graphs..."
            required
        >
        <button type="submit" class="btn btn-primary mt-1">Post Question</button>
    </form>



    <div class="footer">
        @include('layouts.footerbar')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

@endsection