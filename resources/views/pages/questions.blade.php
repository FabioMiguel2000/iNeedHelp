@extends('layouts.navbar')

@section('content')
    <div class="container d-flex justify-content-center flex-wrap">
        <div class="p-4">
            <h1 class="display-5">New Questions</h1>
            @if($new_questions->count())
                @include('partials.question_list',['questions'=>$new_questions]  )
            @else
                <p>No questions found</p>
            @endif
        </div>

        <div class="p-4">
            <h1 class="display-5">Top Questions</h1>
            @if($top_questions->count())
                @include('partials.question_list',['questions'=>$top_questions]  )
            @else
                <p>No questions found</p>
            @endif
        </div>
    </div>

    @include('layouts.footerbar')
@endsection
