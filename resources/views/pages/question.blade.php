@extends('layouts.navbar')

@section('content')
    <style>
        /* body {
                                            font-family: Arial, Helvetica, sans-serif;
                                            margin: 0;
                                        } */
        #your-answer {
            resize: none;
        }

        .submit-btn-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2em 0;
        }

        .new-comment-container {
            justify-content: left;
            display: flex;
            flex-direction: row;
            margin-top: 2.5em;
        }
        .container{
            min-height: 73vh;
        }

    </style>
    <section class="pt-4">

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>

            @endif
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h1 class="display-5">{{ $question->title }}</h1>

                    <div class="ml-auto p-2">
                        @if (Auth::check() && $question->user->username == auth()->user()->username)
                            <div class="row">
                                <div class="col-1 mx-3">
                                    <form action="{{ route('question.edit', $question) }}" method="get">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" id="edit" class="btn btn-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </form>
                                </div>


                                <div class="col-1 mx-3">
                                    <form action="{{ route('question.delete', $question) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" id="delete" class="btn btn-primary">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endif
                    </div>
                </div>


                @if ($question->question_tags->count())
                    <div class="d-flex px-2">
                        @foreach ($question->question_tags as $question_tag)
                            <a href="{{ route('tag', ['id' => $question_tag->tag->id]) }}"
                                class="mx-1 py-2 px-3 text-decoration-none border rounded-pill text-body bg-light text-center">
                                <span class="">#{{ $question_tag->tag->name }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif


                <div class="d-flex">
                    <div class="text-center pt-2">
                        @php
                            $liked = auth()->check() ? $question->likedBy(auth()->user()) : false;
                            $disliked = auth()->check() ? $question->dislikedBy(auth()->user()) : false;
                        @endphp
                        <form action="{{ route('question.review', [$question->id, 'like']) }}" method="post">
                            @csrf
                            @if ($liked)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn"><i
                                    class="fs-4 bi bi-chevron-up @if ($liked)) text-primary @endif"></i></button>
                        </form>
                        <div>{{ $question->score() }}</div>

                        <form action="{{ route('question.review', [$question->id, 'dislike']) }}" method="post">
                            @csrf
                            @if ($disliked)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn">
                                <i class="fs-4 bi bi-chevron-down @if ($disliked) text-danger @endif"></i>
                            </button>
                        </form>
                    </div>

                    <div class="flex-grow-1 p-4">
                        <p>{{ $question->content }}</p>

                        <div class="d-flex justify-content-end pt-2">
                            <div style="min-width: 18rem">
                                <div>Asked by <a class="text-decoration-none"
                                    href="{{ '/user/' . $question->user->username }}">{{ $question->user->username }}
                                </a></div>
                                <div>
                                    {{ \Carbon\Carbon::parse($question->created_at)->toDayDateTimeString() }}
                                </div>

                            </div>
                        </div>

                        @each('partials.comment',$question->comments, 'comment')
                        @if (Auth::check())
                            <form action="{{ route('new-comment') }}" method="post">
                                @csrf
                                <div class="new-comment-container">
                                    <input type="text" name="identifier" style="display: none;"
                                        value="{{ $question->id }}">
                                    <input type="text" name="type" style="display: none;" value="question">
                                    <input class="form-control" name="content" style="margin-right:1.5em; max-width: 80%"
                                        type="text" placeholder="Add a comment" aria-label="default input example">
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </div>
                            </form>
                        @else
                        @endif

                    </div>
                </div>
            </div>
            <hr>

            <p class="fs-4">{{ $question->answers->count() }}
                {{ Str::plural('Answer', $question->answers->count()) }}</p>

            @each('partials.answer', $question->answers->sortByDesc('likes'), 'answer')

            @if (Auth::check())

                <form style="width:1000px; margin: auto; margin-top: 10em;"
                    action="{{ route('new-answer', ['id' => $question->id]) }}" method="post">
                    @csrf
                    {{-- <div>
                        <label for="content">Content</label>
                        <input name="content" type="text" id="content" class="form-control "
                            placeholder="Here you can explain in depth what is the problem.Try to include prints, pictures, graphs..."
                            required>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="form-group">


                        <label style="font-size:1.2em; margin-bottom: 1em;" for="your-answer">Your Answer</label>
                        <textarea class="form-control" id="your-answer" rows="6" name="content"></textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="submit-btn-container">
                        <button type="submit" class="btn btn-primary mt-1">Post Answer</button>
                    </div>
                </form>
            @else

            @endif
        </div>
    </section>


    @include('layouts.footerbar')

@endsection
