<hr>
<div class="d-flex">
    <div class="px-2 text-muted">
        {{ $comment->score() }}
    </div>
    {{ $comment->content }}
    <div class="ms-auto ps-2">
        <a class="text-decoration-none"
           href="{{ '/users/'.$comment->user->username }}">{{ $comment->user->username }}</a>
    </div>
    <div class="ms-2 text-muted">
        {{ \Carbon\Carbon::parse($comment->created_at) }}
    </div>
</div>
