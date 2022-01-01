@extends('layouts.adminSideBar')

@section('content')

<div style="border: solid black 2px; border-radius: 0px 0px 50px 50px;">
    @if ($questions->count())
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Question ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Author Username</th>
                    <th scope="col">Author ID</th>
                    <th scope="col"></th>


                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                    <tr>
                        <th scope="row">{{ $question->id }}</th>
                        <td>{{ \Illuminate\Support\Str::limit($question->title ?? '',35,' ...') }}</td>
                        <td>{{ $question->created_at }}</td>
                        <td>{{ $question->updated_at }}</td>
                        <td>{{ $question->user->username }}</td>
                        <td>{{ $question->user->id }}</td>
                        <td>
                            <form action="{{ route('deleteQuestion', $question->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                @endforeach

            </tbody>
        </table>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-4" class="li: { list-style: none; }">
                {{ $questions->links() }}
            </div>
        </div>
    @else
        <p>No Questions available yet</p>
    @endif


</div>
@endsection
