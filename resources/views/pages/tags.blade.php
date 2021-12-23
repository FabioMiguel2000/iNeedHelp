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

    </style>
</head>
<body>
    <div class="container d-flex justify-content-center flex-wrap">
        <div class="p-4">
            <h1 class="display-5">Tags</h1>

            {{-- @include('partials.question_list',['questions'=>$new_questions]  ) --}}
            <div class="list-group" style="max-width: 28rem">
                @foreach($tags as $tag)
                    {{-- <a href="{{ route('tag', ['id' => $tag->id]) }}"
                       class="list-group-item"> --}}
                        <div class="d-flex justify-content-between">
                            <div class="me-2 text-truncate d-block">
                                <h6 class="">{{ $tag->name }}</h6>
                                <span>{{$tag->name}}</span>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>




    @include('layouts.footerbar')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>

@endsection