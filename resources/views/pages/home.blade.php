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
  .title{
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 2em;
    margin: 2em 0;
  }
  .about-content{
    width: 70%;
    margin: auto;
    background-color: bisque;
    border-radius: 20px;
    padding: 2em 2em 1.5em 2em;
    font-weight: bold;
  }
  .content-wrapper{
    min-height: 68vh;
  }
  .join-us-btn{
    background-color: rgb(251, 124, 21);
    border-radius: 10px;
    width: 10%;
    padding: 0.5em 0.5em 0.5em 0.5em;
    text-align: center;

  }
  .join-us-btn:hover{
    background-color: rgb(249, 112, 0);
  }
  .join-us-btn a{
    text-decoration: none;
    color: white;

  }
  .join-us-btn a:hover{
    color:white;
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
    <div class="content-wrapper">
      <div class="title">
        <img src="{{ asset('assets/logo.png') }}" style="height: 200px; width:200px;" alt="logo">
        <h1>
          Welcome to iNeedHelp
        </h1>
      </div>
      <div class="about-content">
        <p>
          The iNeedHelp project is the development of a web-based information system for managing threads of questions and their respective answers, users, and their information. This is a tool that can be used by anyone, but it is focused on students, teachers, investigators as well as all types of academics
        </p>
        <div class="join-us-btn">
          <a href="{{route('register')}}">Join us</a>
        </div>

      </div>


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