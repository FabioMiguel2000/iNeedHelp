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
            <div>
                <div class="answer-content-container">
                    <p class="answer-content-{{ $answer->id }}"> {{ $answer->content }}</p>
                </div>

                <form action="{{ route('answer.update', $answer) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="answer-edit-{{ $answer->id }}" style="display: none;">
                        <input type="text" name="identifier" style="display: none;" value="{{ $answer->id }}">
                        <input type="text" name="type" style="display: none;" value="answer">
                        <textarea
                            class="form-control"
                            name="content"
                            rows="8"
                            aria-label="Answer"
                        >{{ $answer->content }}</textarea>

                        <button type="button" id="edit" class="btn text-muted"
                                onclick="swapElements('.answer-content-{{ $answer->id }}','.answer-edit-{{ $answer->id }}', false)">
                            Cancel
                        </button>
                        <input class="btn text-primary" type="submit" value="Submit">

                    </div>
                </form>
            </div>

            <div class="d-flex justify-content-between">
                @can('update', $answer)
                    <div class="answer-content-{{ $answer->id }}">
                        <div class="d-flex">
                            <button type="button" id="edit" class="operation-btn"
                                    onclick="swapElements('.answer-content-{{ $answer->id }}','.answer-edit-{{ $answer->id }}', true)">
                                Edit
                            </button>
                            <form action="{{ route('answer.delete', $answer) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="delete" class="operation-btn mx-3">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endcan

                <div class="d-flex">
                    <div>
                        Answered by
                        @if ($answer->user->trashed())
                            <span class="text-muted">Deleted</span>
                        @else
                            <a class="text-decoration-none"
                               href="{{ '/user/' . $answer->user->username }}">{{ $answer->user->username }}</a>
                        @endif
                    </div>

                    <div class="ms-2">
                        <div>{{ $answer->created_at }}</div>
                        @if($answer->created_at != $answer->updated_at)
                            <div>
                                {{ "(edited " . $answer->updated_at .")" }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @each('partials.comment',$answer->comments, 'comment')

            @can ('comment', $answer)
                <form action="{{ route('new-comment') }}" method="post">
                    @csrf
                    <div class="new-comment-container">
                        <input type="text" name="identifier" style="display: none;" value="{{ $answer->id }}">
                        <input type="text" name="type" style="display: none;" value="answer">
                        <input
                            class="form-control"
                            name="content"
                            style="margin-right:1.5em; max-width: 80%"
                            type="text"
                            minlength="2"
                            maxlength="1000"
                            placeholder="Add a comment"
                            aria-label="Add a comment"
                        >
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </form>
            @endcan
        </div>
    </div>

    <hr>
</article>
