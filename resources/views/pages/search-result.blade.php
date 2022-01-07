@extends('layouts.navbar')

@section('content')

    <style>
        .header-container {
            margin: 30px 0 40px 100px;
        }

        .main-container {
            display: flex;
            flex-direction: row;
        }

        .question-results-container {
            display: flex;
            flex-direction: column;
            /*margin: 10px 0 0 100px;*/
        }

        .question-list-container a {
            text-decoration: none;
            color: black;
            font-size: 20px;
        }

        .vertical-divider {
            margin-left: 50px;
            margin-right: 50px;
            width: 1px;
            height: inherit;
            border-left: 1px solid gray;
        }
    </style>
    <div class="container">
        <h2>Search Results</h2>

        <div class="d-flex justify-content-center mt-2">
            <div class="question-results-container">
                <h3 style="margin-bottom: 20px">Questions</h3>
                @forelse ($questions as $question)
                    <div class="question-list-container">
                        <p><a href="{{ '/questions/' . $question->id }}">{{$question->title}}</a></p>
                    </div>
                @empty
                    <div class="nothing-found-container">
                        <p>Sorry... We found nothing :(</p>
                    </div>
                @endforelse

                {{ $questions->withQueryString()->links() }}
            </div>

            <div class="vertical-divider"></div>

            <div class="user-results-container">
                <h3 style="margin-bottom: 20px">Users</h3>
                @forelse($users as $user)
                    <div class="question-list-container">
                        <p><a href="{{ route('user', $user->username) }}">{{$user->username}}</a></p>
                    </div>
                @empty
                    <div class="nothing-found-container">
                        <p>Sorry... We found nothing :(</p>
                    </div>
                @endforelse

                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>

    @include('layouts.footerbar')



@endsection
