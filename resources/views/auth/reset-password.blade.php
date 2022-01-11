<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>iNeedHelp | Recover Account</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
<div class="container mt-5">

    @if (session('success'))
        <div class="alert alert-success mx-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mx-4" role="alert">
            {{ $errors->first() }}
        </div>

    @endif

    <a href="{{ route('home') }}">
        <img src="{{ asset('assets/logo.png') }}" class="d-block mx-auto" style="max-height: 12rem" alt="logo">
    </a>


    <form action="{{ route('password.reset') }}" method="post" class="row justify-content-center g-3 mx-auto"
          style="max-width: 32rem">
        @csrf

        <div class="text-center">
            {{-- <h1>iNeedHelp</h1> --}}
            <h2>Account Recovery</h2>
        </div>
        <input type="hidden" name="token" value="{{ $request->token }}">
        {{-- <input type="hidden" name="email" value="{{old('email', $request->email)}}"> --}}

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-control" type="email" name="email"
                   value="{{old('email', $request->email)}}" required autofocus readonly/>
        </div>




        <div>
            <label for="password" class="form-label">New Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   required>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="password_confirmation" class="form-label">New Password (Again)</label>
            <input name="password_confirmation" type="password"
                   class="form-control @error('password_confirmation') is-invalid @enderror" required>

            @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col d-grid">
            <button type="submit" class="btn btn-primary mt-1">Change Password</button>
        </div>

        <p class="text-muted mt-4">© LBAW2153 {{ date('Y') }}</p>
    </form>
</div>
</body>

</html>
