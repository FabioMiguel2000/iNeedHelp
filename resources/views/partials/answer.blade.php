<article>
    <div class="d-flex">
        <div class="text-center pt-2">
            <button type="button" class="btn"><i class="fs-4 bi bi-chevron-up"></i></button>
            <div>{{ $answer->score() }}</div>
            <button type="button" class="btn"><i class="fs-4 bi bi-chevron-down"></i></button>
        </div>

        <div class="flex-grow-1 p-4">
            <p> {{ $answer->content }}</p>

            <div class="d-flex justify-content-end">
                <div style="min-width: 18rem">
                    <div>Answered {{  \Carbon\Carbon::parse($answer->created_at)->toDayDateTimeString() }}</div>
                    <a class="text-decoration-none"
                       href="{{ '/users/'.$answer->user->username }}">{{ $answer->user->username }}</a>
                </div>
            </div>

            @each('partials.comment',$answer->comments, 'comment')
        </div>
    </div>
    <hr>
</article>
