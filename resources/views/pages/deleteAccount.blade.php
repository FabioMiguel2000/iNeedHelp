<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>iNeedHelp | Delete Account</title>

    <link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous"
    >
</head>

<body>
<div class="container mt-5">

    @if(Session::has('success'))

        <div class="alert alert-success" id="alert">
            <strong>Success:</strong> {{Session::get('success')}}
        </div>

    @elseif(session('error'))
        <div class="alert alert-danger" id="alert">  
            <strong>Error: </strong>{{Session::get('error')}}
        </div>
    @endif

    <a href="{{route('home')}}">
        <img src="{{ asset('assets/logo.png') }}" class="d-block mx-auto" style="max-height: 12rem" alt="logo">
    </a>

    <h2 class="text-center">Are you sure you want to Delete your Account</h2>

    <h4 class="text-center">Once you delete your account you won't be able to get it back! :( <br> Please insert your credentials to confirm your identity</h4>
    <br>


    @if (session('status'))
        <div class="alert alert-danger" role="alert">
            {{session('status')}}
        </div>
    @endif

    <form
        action="{{ route('confirmed-delete', auth()->user()->username) }}"
        method="POST"
        class="row justify-content-center g-3 mx-auto"
        style="max-width: 32rem"
    >
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Email address</label>
            <input
                name="email"
                type="text"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder=""
                required
            >

            @error('email')
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
            
            <a href="{{route('user', auth()->user()->username)}}">
                Go back
            </a>
            
        </div>
        <div class="col d-grid">
            <button type="submit" class="btn btn-danger mt-1">Delete Account</button>
        </div>


        <p class="text-muted mt-4">© LBAW2153 {{ date('Y') }}</p>
    </form>
</div>
</body>
</html>



