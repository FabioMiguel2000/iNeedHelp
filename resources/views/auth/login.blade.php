<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>iNeedHelp | Sign in</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous"
    >
</head>

<body>
<div class="container mt-5">

    <a href="{{route('home')}}">
        <img src="{{ asset('assets/logo.png') }}" class="d-block mx-auto" style="max-height: 12rem" alt="logo">
    </a>

    <h2 class="text-center">Sign in</h2>

    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{session('status')}}
        </div>
    @endif

    <form
        action="{{ route('login') }}"
        method="post"
        class="row justify-content-center g-3 mx-auto"
        style="max-width: 32rem"
    >
        @csrf

        <div class="col-12">
            <label for="usernameOrEmail" class="form-label">Username or email address</label>
            <input
                name="usernameOrEmail"
                type="text"
                value="{{ old('usernameOrEmail') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder=""
                required
            >

            @error('usernameOrEmail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input
                name="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                required
            >
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="col d-grid">
            <button type="submit" class="btn btn-primary mt-1">Sign in</button>
        </div>

        <a class="text-center" href="{{route('register')}}">Don't have an account? Sign up</a>

        <p class="text-muted mt-4">© LBAW2153 {{ date('Y') }}</p>
    </form>
</div>
</body>
</html>



