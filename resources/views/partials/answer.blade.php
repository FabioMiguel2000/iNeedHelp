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

            <form action="{{ route('answer.review', [$answer->id, 'dislike']) }}" method="post">
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
            <p> {{ $answer->content }}</p>

          @if($answer->user->username == auth()->user()->username)
                <div class="row">
                    <div class="col-1">
                        <button type="button" id="edit" class="btn btn-primary">
                            <i class="bi bi-pencil-fill"></i>
                        </button>
                    </div>
                    

                    <div class="col-1">
                        <form action="{{route('answer.delete',$answer)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete" class="btn btn-primary">
                                <i class="bi bi-trash"></i>
                            </button>                
                            </form>
                    </div>

                </div>                
            @endif          

            <div class="d-flex justify-content-end">
                <div style="min-width: 18rem">
                    <div>Answered {{  \Carbon\Carbon::parse($answer->created_at)->toDayDateTimeString() }}</div>
                    <a class="text-decoration-none"
                       href="{{ '/user/'.$answer->user->username }}">{{ $answer->user->username }}</a>
                </div>
            </div>

            @each('partials.comment',$answer->comments, 'comment')
        </div>
    </div>
    <hr>
</article>
