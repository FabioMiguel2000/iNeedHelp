@extends('layouts.navbar')

@section('content')
    <div class="container">
        <h1 class="display-5 fw-bold">Tags</h1>

        <div class="d-flex flex-wrap justify-content-center">
            @foreach($tags as $tag)
                <a
                    href="{{ route('tag', ['id' => $tag->id]) }}"
                    class="text-decoration-none p-2 px-3 m-2 border rounded"
                    style="max-width: 16rem"
                >
                    <div class="border rounded-pill d-inline-block px-2 py-1 bg-light">
                        {{$tag->name}}
                    </div>

                    @forelse($tag->questions()->orderBy('created_at','desc')->limit(3)->get() as $question)
                        <div class="text-muted text-truncate">
                            {{ $question->title }}
                        </div>
                    @empty
                        <div class="text-muted text-truncate">
                            No questions for this tag yet
                        </div>
                    @endforelse
                </a>
            @endforeach

        </div>
        <div>
            <style>
                .pagination {
                    justify-content: center;
                }
            </style>
            {{ $tags->links() }}
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
