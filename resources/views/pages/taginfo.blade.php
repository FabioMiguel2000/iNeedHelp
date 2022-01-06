@extends('layouts.navbar')

@section('content')

    <div class="container">
        <h1 class="display-4">#{{ $tag->name }}</h1>

        <div class="list-group my-4" style="max-width: 50rem">
            @foreach($tag->questions as $question)
                <a href="{{ route('question', ['id' => $question->id]) }}"
                   class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div class="me-2 text-truncate d-block">
                            <h6 class="">{{ $question->title }}</h6>
                        </div>
                        <div class="flex-shrink-0 text-muted">
                            <span> {{$question->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
