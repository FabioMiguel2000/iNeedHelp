@extends('layouts.navbar')

@section('content')
    <section class="pt-4">
        <div class="container">
            <div class="d-flex flex-column">
                <h1 class="display-5">{{ $question->title }}</h1>

                <div class="d-flex">
                    <div class="text-center pt-2">
                        @php
                            $liked = auth()->check()?$question->likedBy(auth()->user()): false;
                            $disliked = auth()->check()?$question->dislikedBy(auth()->user()): false;
                        @endphp
                        <form
                            action="{{ route('question.review', [$question->id, 'like']) }}"
                            method="post"
                        >
                            @csrf
                            @if($liked)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn"><i
                                    class="fs-4 bi bi-chevron-up @if($liked)) text-primary @endif"></i></button>
                        </form>
                        <div>{{$question->score()}}</div>

                        <form
                            action="{{ route('question.review', [$question->id, 'dislike']) }}"
                            method="post"
                        >
                            @csrf
                            @if($disliked)
                                @method('DELETE')
                            @endif
                            <button
                                type="submit"
                                class="btn"
                            >
                                <i class="fs-4 bi bi-chevron-down @if($disliked) text-danger @endif"></i>
                            </button>
                        </form>
                    </div>

                    <div class="flex-grow-1 p-4">
                        <p>{{ $question->content }}</p>

                        <div class="d-flex justify-content-end pt-2">
                            <div style="min-width: 18rem">
                                <div>
                                    Asked {{  \Carbon\Carbon::parse($question->created_at)->toDayDateTimeString() }}
                                </div>
                                <a class="text-decoration-none"
                                   href="{{ '/users/'.$question->user->username }}">{{ $question->user->username }}
                                </a>
                            </div>
                        </div>

                        @each('partials.comment',$question->comments, 'comment')
                    </div>
                </div>
            </div>
            <hr>

            <p class="fs-4">{{ $question->answers->count() }} {{ Str::plural('Answer',$question->answers->count())}}</p>

            @each('partials.answer', $question->answers, 'answer')
        </div>
    </section>


    @include('layouts.footerbar')

@endsection
