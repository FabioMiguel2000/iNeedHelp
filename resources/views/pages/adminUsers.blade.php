@extends('layouts.adminSideBar')

@section('content')
    <div style="border: solid black 2px; border-radius: 0px 0px 50px 50px;">
        @if ($users->count())
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">User ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Banned</th>
                        <th scope="col">Created At</th>
                        <th scope="col"></th>
                        <th scope="col"></th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td> <a href="{{ '/user/' . $user->username }}" style="text-decoration: underline; color:blue">{{ $user->username }}</a> </td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>{{ $user->is_blocked ? 'True' : 'False' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                @if ($user->is_blocked)
                                    <form action="{{ route('changeBlock', $user->id) }}" method="post">
                                        @csrf

                                        <button class="btn btn-warning" type="submit"><i
                                                class='bi bi-unlock-fill'></i></button>
                                    </form>

                                @else

                                    <form action="{{ route('changeBlock', $user->id) }}" method="post">
                                        @csrf

                                        <button class="btn btn-warning" type="submit"><i
                                                class='bi bi-lock-fill'></i></button>
                                    </form>

                                @endif

                                {{-- <form action="" method="post">

                            </form> --}}
                            </td>
                            <td>

                                <form action="{{ route('deleteUser', $user->id) }}" method="post">
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
                    {{ $users->links() }}
                </div>
            </div>
        @else
            <p>No Users available yet</p>
        @endif


    </div>

@endsection
