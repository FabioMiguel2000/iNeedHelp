@extends('layouts.navbar')

@section('content')
    <div class="content-container">
        <div class="container d-flex flex-wrap">
            <div class="p-4">
                <h1 class="display-5">Tags</h1>

                <div class="list-group" style="max-width: 28rem">
                    @foreach($tags as $tag)
                        <a href="{{ route('tag', ['id' => $tag->id]) }}"
                           class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="me-2 text-truncate d-block">
                                    {{-- <h6 class="">{{ $tag->id }}</h6> --}}
                                    <span>{{$tag->name}}</span>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
