@extends('layouts.navbar')

@section('content')
    <style>
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

    </style>
    <section class="pt-4">
        <div class="container">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h1 class="display-5" style="font-weight: bold;">{{ $question->title }}</h1>

                    <div class="ml-auto p-2">
                        <div class="row">

                        </div>
                    </div>
                </div>

                @if ($question->tags->count())
                    <div class="d-flex">
                        @foreach ($question->tags as $tag)
                            <a href="{{ route('tag', $tag->id) }}"
                                class="mx-1 py-2 px-3 text-decoration-none border rounded-pill text-body bg-light text-center">
                                <span>#{{ $tag->name }}</span>
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

                        <form action="{{ route('question.unreview', [$question->id, 'dislike']) }}" method="post">
                            @csrf
                            @if ($disliked)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn">
                                <i class="fs-4 bi bi-chevron-down @if ($disliked) text-danger @endif"></i>
                            </button>
                        </form>

                        {{-- @if ($answer->isAccepted())
                            @can('accept', [$answer->question, $answer])
                                <form action="{{ route('question.unaccept', [$answer->question_id, $answer->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Undo accept">
                                        <i class="bi bi-check-circle-fill text-success"></i>
                                    </button>
                                </form>
                            @else
                                <i class="bi bi-check-circle-fill text-success"></i>
                            @endcan
                        @else
                            @can('accept', [$answer->question, $answer])
                                <form action="{{ route('question.accept', [$answer->question_id, $answer->id]) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                </form>
                            @endcan
                        @endif --}}

                        @if (auth()->check() &&
    auth()->user()->isFollowing($question->id))
                            <form action="{{ route('question.unfollow', $question) }}" method="post">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="Undo accept">
                                    <i class="bi bi-bookmark-check-fill"></i>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('question.follow', $question) }}" method="post">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn" data-bs-toggle="tooltip"
                                    data-bs-placement="right" title="Undo accept">
                                    <i class="bi bi-bookmark-plus"></i>
                                </button>
                            </form>
                        @endif

                    </div>

                    <div class="flex-grow-1 p-4">
                        <div class="question-content-container" style="padding: 1.5em 0 5em 0">
                            <p>{{ $question->content }}</p>
                        </div>
                        @can('update', $question)
                        <div class="question-operations-container"
                            style="color: #6A737C; font-size: 0.8em; display:flex; flex-direction:row; height: 1.8em;">
                            <a href="{{ route('question.edit', $question) }}" style="text-decoration:none;">
                                <p style="margin-right:1.5em; color: #6A737C;">Edit</p>
                            </a>
                            <a href="" id="delete-question-btn" style="text-decoration:none;">
                                <p style="color: #6A737C;">Delete</p>
                            </a>

                            <form action="{{ route('question.delete', $question) }}" id="invisible-delete-question-btn"
                                style="display:none" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    style="border: none; color:#6A737C; background:none; font-family:arial, sans-serif;">Delete</button>
                            </form>
                            <script>
                                document.getElementById("delete-question-btn").addEventListener('click', (e) => {
                                    e.preventDefault()
                                    document.getElementById("invisible-delete-question-btn").submit()
                                })
                            </script>
                        </div>

                        @endcan
                        <div class="d-flex justify-content-end pt-2">

                            <div style="min-width: 18rem">
                                <div>Asked by
                                    @if ($question->user == null || $question->user->trashed())
                                        Deleted User
                                    @else
                                        <a class="text-decoration-none"
                                            href="{{ '/user/' . $question->user->username }}">{{ $question->user->username }}
                                        </a>
                                    @endif

                                </div>

                                <div>
                                    {{ $question->updated_at }}
                                </div>

                            </div>
                        </div>

                        @each('partials.comment',$question->comments, 'comment')
                        @if (Auth::check() && !auth()->user()->is_blocked)
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

            @if (Auth::check() && !auth()->user()->is_blocked)

                <form class="mx-auto" style="max-width: 50rem"
                    action="{{ route('new-answer', ['id' => $question->id]) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label style="font-size:1.2em; margin-bottom: 1em; font-weight: bold;" for="your-answer">
                            Your Answer
                        </label>
                        <textarea class="form-control" id="your-answer" rows="10" name="content"
                            style="font-size: 0.8em"></textarea>

                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="submit-btn-container">
                        <button type="submit" class="btn btn-primary mt-1">Post Answer</button>
                    </div>
                </form>
            @else
                <a class="d-block text-center" style="margin-top: 10vh;" href="{{ route('login') }}">Sign in to answer to this question</a>
            @endif
        </div>

    </section>

    @include('layouts.footerbar')
@endsection
