{{-- @extends('layouts.navbar')

@section('content')
<style>
    #content{
        margin-top: 2em;
        margin-right: 25%;
        margin-left: 25%;

    }
    .card-header{
        font-size: 1.7em;
    }
    #top-question-container{

    }

</style>
{{-- <div id="content">
    <div class="card text-center" id="top-question-container">
        <div class="card-header">
          Top Questions
        </div>
        <div class="card-body">
            <div class="list-group">
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Question 1</h5>
                  <small>3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small>And some small print.</small>
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Question 2</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small class="text-muted">And some muted small print.</small>
              </a>
              <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">Question 3</h5>
                  <small class="text-muted">3 days ago</small>
                </div>
                <p class="mb-1">Some placeholder content in a paragraph.</p>
                <small class="text-muted">And some muted small print.</small>
              </a>
            </div>
        </div>
      </div>

</div> --}}

@extends('layouts.navbar')

@section('content')

<style>
  .wrapper{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 75vh;
    text-align: center;
    font-size: 2em;
  
  }
</style>
    {{-- <div class="container d-flex justify-content-center flex-wrap">
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
    </div> --}}

    <div class="wrapper">
      This is the Home Page
    </div>


    {{-- <div id="content">
      <div class="card text-center" id="top-question-container">
          <div class="card-header">
            Top Questions
          </div>
          <div class="card-body">
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Question 1</h5>
                    <small>3 days ago</small>
                  </div>
                  <p class="mb-1">Some placeholder content in a paragraph.</p>
                  <small>And some small print.</small>
                </a>

              </div>
          </div>
        </div>
  
  </div> --}}

    @include('layouts.footerbar')

@endsection