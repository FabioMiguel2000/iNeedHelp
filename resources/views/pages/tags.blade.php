@extends('layouts.navbar')

@section('content')
    <div class="container">
        <h1 class="display-5 fw-bold">Tags</h1>

        <div class="d-flex flex-wrap">
            @foreach($tags as $tag)
                <a
                    href="{{ route('tag', ['id' => $tag->id]) }}"
                    class="text-decoration-none p-2 px-3 m-2 border rounded flex-grow-1"
                >
                    <div class="border rounded-pill d-inline-block px-2 py-1 bg-light">
                        {{$tag->name}}
                    </div>

                    <div class="text-muted text-truncate">
                        @if($q = $tag->questions()->count())
                            {{ $q }} {{ Str::plural('Question', $q) }}
                        @else
                            No Questions yet
                        @endif
                    </div>
                </a>
            @endforeach

        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $tags->links() }}
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
