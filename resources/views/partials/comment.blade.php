<hr>
<div class="d-flex" >
    <div class="px-2 text-muted">
        {{ $comment->score() }}
    </div>
    <div>
        <div id="comment{{$comment->id}}" style="display: block">
            {{ $comment->content }}
        </div>
        <div class="d-flex" id="coisas{{$comment->id}}">
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
            @if(Auth::check() && $comment->user->username == auth()->user()->username && !auth()->user()->is_blocked)

                {{-- Edit Comment --}}
                <div class="px-1">
                    {{-- <form action="" method="post">  {{ route('comment.edit', [$comment->id]) }} --}}
                        {{-- @csrf --}}
                        {{-- @method('PATCH') --}}

                        {{-- </form> --}}
                        <button type="submit" class="btn p-0 text-muted" onclick="changeDivs2({{$comment->id}})"> Edit</button>
                </div>

                {{-- Delete Comment --}}
                <div class="px-1">
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

{{-- <div class="d flex" id= "comment-edit{{$comment->id}}" style="display: none; width:40rem"> --}}
    <form action="{{ route('comment.update', $comment) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="d flex" id= "comment-edit{{ $comment->id }}" style="display: none; width:40rem">
            <input type="text" name="identifier" style="display: none;"
                   value="{{ $comment->id }}">
            <input type="text" name="type" style="display: none;" value="comment">
            <input class="form-control" name="content" style="margin-right:1.5em; max-width: 80%"
                   type="text"
                   value={{$comment->content}} aria-label="default input example">


                <button type="button" id="edit" class="btn btn-primary" onclick="changeDivs2({{$comment->id}})">
                    Cancel
                </button>
            <input class="btn btn-primary" type="submit" value="Submit">

        </div>
    </form>
{{-- </div> --}}

<script>
    function changeDivs2(id) {
        var zz = document.getElementById("comment"+id);
        var z = document.getElementById("comment-edit"+id);
        if (z.style.display === "none") {
            z.style.display = "block";
            zz.style.display = "none";
        } else {
            z.style.display = "none";
            zz.style.display = "block";
        }
    }
</script>
