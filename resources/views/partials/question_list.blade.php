<div class="list-group" style="max-width: 28rem">
    @foreach($questions as $question)
        <a href="{{ route('question', ['id' => $question->id]) }}"
           class="list-group-item">
            <div class="d-flex justify-content-between">
                <div class="me-2 text-truncate d-block">
                    <h6 class="">{{ $question->title }}</h6>
                    <span>{{$question->content}}</span>
                </div>
                <div class="flex-shrink-0 text-muted">
                    <span> {{$question->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
    @endforeach
</div>
