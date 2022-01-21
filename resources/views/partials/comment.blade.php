<hr>
<div class="d-flex">
    <div class="px-2 text-muted">
        {{ $comment->score() }}
    </div>

    <div class="flex-grow-1">
        <div>
            <div class="comment-{{$comment->id}}">
                {{ $comment->content }}
            </div>

            <form
                action="{{ route('comment.update', $comment) }}"
                method="post"
                class="d flex comment-edit-{{ $comment->id }}"
                style="display: none;"
            >
                @csrf
                @method('PATCH')
                <div>
                    <input type="text" name="identifier" style="display: none;"
                           value="{{ $comment->id }}">
                    <input type="text" name="type" style="display: none;" value="comment">
                    <input class="form-control"
                           name="content"
                           type="text"
                           value="{{$comment->content}}"
                           minlength="2"
                           maxlength="1000"
                           style="margin-right:1.5em; max-width: 80%"
                           aria-label="default input example"
                    >


                    <button
                        type="button"
                        class="btn text-muted p-0"
                        onclick="swapElements('.comment-{{$comment->id}}', '.comment-edit-{{$comment->id}}', false)"
                    >
                        Cancel
                    </button>
                    <button class="btn text-primary p-0 px-1" type="submit">Submit</button>
                </div>
            </form>


        </div>

        <div class="d-flex flex-wrap">
            <div class="d-flex comment-{{$comment->id}}">
                <div >
                    @php
                        $liked = auth()->check() ? $comment->likedBy(auth()->user()) : false;
                    @endphp
                    <div>
                        <form action="{{ route('comment.review', [$comment->id, 'like']) }}" method="post">
                            @csrf
                            @if ($liked)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="btn p-0 text-muted">@if($liked)Not @endif Useful</button>
                        </form>
                    </div>
                </div>

                @can('update', $comment)

                    {{-- Edit Comment --}}
                    <div class="px-2">
                        <button type="submit" class="btn p-0 text-muted"
                                onclick="swapElements('.comment-{{$comment->id}}', '.comment-edit-{{$comment->id}}', true)">
                            Edit
                        </button>
                    </div>

                    {{-- Delete Comment --}}
                    <div>
                        <form action="{{ route('comment.delete', [$comment]) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn p-0 text-muted"> Delete</button>
                        </form>
                    </div>
                @endcan
            </div>

            <div class="ms-auto ps-2">
                <div class="d-flex">
                    @if ($comment->user->trashed())
                        <span class="text-muted">Deleted</span>
                    @else
                        <a class="text-decoration-none"
                           href="{{ '/user/'.$comment->user->username }}">{{ $comment->user->username }}</a>
                    @endif

                    <div class="ms-2">{{ $comment->created_at }}</div>
                </div>

                <div class="text-muted">
                    @if($comment->created_at != $comment->updated_at)
                        <div>
                            {{ "(edited " . $comment->updated_at .")" }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
