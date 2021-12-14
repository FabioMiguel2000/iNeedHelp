@extends('layouts.navbar')

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
<div id="content">
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

</div>

@endsection