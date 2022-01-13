@extends('layouts.navbar')

@section('content')
    <style>
        .title {
            padding-bottom: 1rem;
        }

        .parameter {
            margin-bottom: 1rem;
        }

        .parameter p {
            font-size: 0.7em;
            margin-bottom: 0;
        }

        .parameter label {
            font-weight: bold;
        }

        .parameter input, .parameter textarea {
            font-size: 0.8em;
        }
    </style>

    <div class="container">
        {{-- <div class="title">
            <h1></h1>
            <p>Here you can create your question</p>
        </div> --}}
        <div class="alert alert-warning" role="alert" style="white-space: pre-wrap">
            Notes:
            We welcome all constructive edits, but please make them substantial. Avoid trivial edits unless absolutely necessary.
        </div>

        <form style="margin:auto" action="{{ route('question.update', $question) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="parameter">
                <label for="title">Question Title</label>
                <p>Be specific and imagine you’re asking a question to another person</p>
                <input
                    name="title"
                    type="text"
                    id="title"
                    class="form-control"
                    placeholder="Try to insert a brief description of the problem while including the more relevant aspects"
                    minlength="10"
                    maxlength="100"
                    value="{{$question->title}}"
                    required
                >
                @error('title')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="parameter">
                <label for="content">Content</label>
                <p>Include all the information someone would need to answer your question</p>
                <textarea
                    name="content"
                    class="form-control"
                    id="content"
                    rows="10"
                    minlength="10"
                    maxlength="10000"
                    required
                >{{$question->content}}</textarea>
                @error('content')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="parameter">
                <label for="tags">Tags</label>
                <p>
                    Add up to 5 tags to describe what your question is about (note: insert tags separated by commas)
                </p>
                <input
                    name="tags"
                    type="text"
                    id="tags"
                    class="form-control"
                    placeholder="e.g.(Java, VPN, exampleTag)"
                >
            </div>

            <div style="margin-bottom: 4em;">
                <button type="submit" class="btn btn-primary mt-1">Update Question</button>
            </div>
        </form>
    </div>

    @include('layouts.footerbar')
@endsection
