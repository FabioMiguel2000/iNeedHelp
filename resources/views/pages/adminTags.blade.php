@extends('layouts.adminSideBar')

@section('content')

<div style="border: solid black 2px; border-radius: 0px 0px 50px 50px;">
    @if ($tags->count())
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Tag ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col"></th>


                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <th scope="row">{{ $tag->id }}</th>
                        <td>{{ $tag->name }}</td>
                        <td></td>
                        <td></td>
                        <td>
                            <form action="{{ route('deleteTag', $tag->id) }}" method="post">
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
                {{ $tags->links() }}
            </div>
        </div>
    @else
        <p>No Tags available yet</p>
    @endif


</div>
@endsection
