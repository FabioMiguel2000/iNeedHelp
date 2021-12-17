@extends('layouts.navbar')

@section('content')
    <section>
        <div class="container">
            <div class="d-flex flex-column">
                <h1 class="display-5">{{ $question->title }}</h1>

                <div class="d-flex">
                    <div class="text-center pt-2">
                        <button type="button" class="btn"><i class="fs-4 bi bi-chevron-up"></i></button>
                        <div>{{$question->score()}}</div>
                        <button type="button" class="btn"><i class="fs-4 bi bi-chevron-down"></i></button>
                    </div>

                    <div class="flex-grow-1 p-4">
                        <p>{{ $question->content }}</p>

                        <div class="d-flex justify-content-end pt-2">
                            <div style="min-width: 18rem">
                                <div>
                                    Asked {{  \Carbon\Carbon::parse($question->created_at)->toDayDateTimeString() }}</div>
                                <a class="text-decoration-none"
                                   href="{{ '/users/'.$question->user->username }}">{{ $question->user->username }}</a>
                            </div>
                        </div>

                        @each('partials.comment',$question->comments, 'comment')
                    </div>
                </div>
            </div>
            <hr>

            @switch($c = $question->answers->count())
                @case(1)
                <p class="fs-4">{{ $c }} Answer</p>
                @break

                @default
                <p class="fs-4">{{ $c }} Answers</p>
            @endswitch

            @each('partials.answer', $question->answers, 'answer')
        </div>
    </section>
@endsection
