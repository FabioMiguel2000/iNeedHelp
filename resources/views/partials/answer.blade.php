<style>
    .operation-btn {
        border: none;
        background: none;
        color: #6A737C;
        padding: 0;
    }

</style>

<article>
    <div class="d-flex">
        <div class="text-center pt-2">
            @php
                $liked = auth()->check() ? $answer->likedBy(auth()->user()) : false;
                $disliked = auth()->check() ? $answer->dislikedBy(auth()->user()) : false;
            @endphp
            <form action="{{ route('answer.review', [$answer->id, 'like']) }}" method="post">
                @csrf
                @if ($liked)
                    @method('DELETE')
                @endif
                <button type="submit" class="btn"><i
                        class="fs-4 bi bi-chevron-up @if ($liked)) text-primary @endif"></i></button>
            </form>

            <div>{{ $answer->score() }}</div>

            <form action="{{ route('answer.unreview', [$answer->id, 'dislike']) }}" method="post">
                @csrf
                @if ($disliked)
                    @method('DELETE')
                @endif
                <button type="submit" class="btn">
                    <i class="fs-4 bi bi-chevron-down @if ($disliked) text-danger @endif"></i>
                </button>
            </form>

            @if ($answer->isAccepted())
                @can('accept', [$answer->question, $answer])
                    <form action="{{ route('question.unaccept', [$answer->question_id, $answer->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Undo accept">
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
            @endif
        </div>

        <div class="flex-grow-1 p-4">

            <div class="d-flex justify-content-between">
                <div class="answer-content-container" style="padding: 1.5em 0 5em 0">
                    <p class="answer-content-{{ $answer->id }}"> {{ $answer->content }}</p>
                </div>
                {{-- <p class="answer-content-{{ $answer->id }}"> {{ $answer->content }}</p> --}}


                <form action="{{ route('answer.update', $answer) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="d flex answer-edit-{{ $answer->id }}" style="display: none; width:40rem">
                        <input type="text" name="identifier" style="display: none;" value="{{ $answer->id }}">
                        <input type="text" name="type" style="display: none;" value="answer">
                        <input class="form-control" name="content" style="margin-right:1.5em; max-width: 80%"
                            type="text" value="{{ $answer->content }}" aria-label="default input example">

                        <button type="button" id="edit" class="btn btn-primary"
                            onclick="swapElements('.answer-content-{{ $answer->id }}','.answer-edit-{{ $answer->id }}', false)">
                            Cancel
                        </button>
                        <input class="btn btn-primary" type="submit" value="Submit">

                    </div>
                </form>

                {{-- @if ((!($answer->user == null || $answer->user->trashed()) && (Auth::check() && $answer->user->username
                == auth()->user()->username)) ||
                (Auth::check() &&
                auth()->user()->isModerator()))
                <div class="ml-auto p-2">
                    <div class="row">
                        <div class="col-1 px-4">
                            <button type="button" id="edit" class="btn btn-primary"
                                onclick="swapElements('.answer-content-{{ $answer->id }}','.answer-edit-{{ $answer->id }}', true)">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </div>


                        <div class="col-1 px-4">
                            <form action="{{ route('answer.delete', $answer) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="delete" class="btn btn-primary">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
                @endif --}}
            </div>
            @if ((!($answer->user == null || $answer->user->trashed()) && (Auth::check() && $answer->user->username
            == auth()->user()->username)) ||
            (Auth::check() &&
            auth()->user()->isModerator()))
            <div class="answer-operations-container"
                style="color: #6A737C; font-size: 0.8em; display:flex; flex-direction:row; height: 1.8em;">
                <form action="">
                    <button type="button" id="edit" class="operation-btn" style="margin-right: 1.5em"
                    onclick="swapElements('.answer-content-{{ $answer->id }}','.answer-edit-{{ $answer->id }}', true)">
                    Edit
                </button>
                </form>
                <form action="{{ route('answer.delete', $answer) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="delete" class="operation-btn">
                        Delete
                    </button>
                </form>
            </div>
            @endif
            <div class="d-flex justify-content-end">
                <div style="min-width: 18rem">
                    <div>Answered by
                        @if ($answer->user == null || $answer->user->trashed())
                            Deleted User
                        @else
                            <a class="text-decoration-none"
                                href="{{ '/user/' . $answer->user->username }}">{{ $answer->user->username }}</a>
                        @endif
                    </div>
                    <div>{{ $answer->updated_at }}</div>
                </div>
            </div>

            @each('partials.comment',$answer->comments, 'comment')

            @if (Auth::check() && !auth()->user()->is_blocked)
                <form action="{{ route('new-comment') }}" method="post">
                    @csrf
                    <div class="new-comment-container">
                        <input type="text" name="identifier" style="display: none;" value="{{ $answer->id }}">
                        <input type="text" name="type" style="display: none;" value="answer">
                        <input class="form-control" name="content" style="margin-right:1.5em; max-width: 80%"
                            type="text" placeholder="Add a comment" aria-label="default input example">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            @else
            @endif
        </div>
    </div>

    <hr>
</article>
