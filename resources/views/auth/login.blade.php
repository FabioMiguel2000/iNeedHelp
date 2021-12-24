{{-- @extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form>
@endsection --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>iNeedHelp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
      form {
        max-width: 32rem;
        margin: auto;
      }
    </style>
</head>
<body>
  <div class="p-4 md-p">

      <form 
        action="{{ route('login') }}"
        method="post"
        class="row justify-content-center g-3 mx-auto"
      >
        @csrf

        <div class="text-center">
          <h1>iNeedHelp</h1>
          <h2>Login</h2>
        </div>
        @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{session('status')}}
        </div>
      @endif
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
            <button type="submit" class="btn btn-primary mt-1">Sign up</button>
        </div>

        <p class="text-muted mt-4" >© LBAW2153 2021  </p>
      </form>
  </div>
</body>
</html>



