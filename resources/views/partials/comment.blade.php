<hr>
<div class="d-flex">
    <div class="px-2 text-muted">
        {{ $comment->score() }}
    </div>
    <div>
        {{ $comment->content }}
        <div class="d-flex">
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

            {{-- If User is logged in and is the owner of the comment --}}
            @if(Auth::check() && $comment->user->username == auth()->user()->username)

                {{-- Edit Comment --}}
                <div class="p-1">
                    <form action="" method="post">  {{--{{ route('comment.edit', [$comment->id]) }} --}}
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="btn p-0 text-muted"> Edit</button>
                    </form>
                </div>

                {{-- Delete Comment --}}
                <div class="p-1">
                    <form action="{{ route('comment.delete', [$comment]) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn p-0 text-muted"> Delete</button>
                    </form>
                </div>

            @endif
            {{--        <div>{{ $comment->score() }}</div>--}}

            {{--        <form action="{{ route('comment.review', [$comment->id, 'dislike']) }}" method="post">--}}
            {{--            @csrf--}}
            {{--            @if ($disliked)--}}
            {{--                @method('DELETE')--}}
            {{--            @endif--}}
            {{--            <button type="submit" class="btn">--}}
            {{--                <i class="fs-4 bi bi-chevron-down @if ($disliked) text-danger @endif"></i>--}}
            {{--            </button>--}}
            {{--        </form>--}}
        </div>
    </div>

    <div class="ms-auto ps-2">
        <a class="text-decoration-none"
           href="{{ '/user/'.$comment->user->username }}">{{ $comment->user->username }}</a>
    </div>
    <div class="ms-2 text-muted">
        {{ $comment->created_at }}
    </div>
</div>
