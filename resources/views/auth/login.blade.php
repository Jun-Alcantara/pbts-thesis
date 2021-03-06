@extends('layouts.main')
@push('custom-css')
    <style>
        .container {
            margin-top: 25vh;
            max-width: 500px;
        }

        .main-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 90vw;
            margin: 0 auto;
        }

        .login-card {
            padding: 50px 70px;
            border: 3px solid #c7753d;
            background-color: #83b9bb;
            border-radius: 30px;
            position: relative;
        }

        .login-card > input {
            display: block;
            margin-bottom: 20px;
            border: 2px solid #c7753d;
            background-color: #ffa83e;
        }

        .login-btn {
            border: 2px solid #c7753d;
            background-color: #ffa83e;
            font-weight: 600;
            padding: 10px 17px;
            border-radius: 30px;
        }

        .input-container {
            padding: 10px 10px;
            background-color: #ffa83e;
            margin-bottom: 20px;
            border: 2px solid #c7753d;
            border-radius: 7px;
        }

        input {
            border: none;
            background: transparent !important;
            width: 100%;
            outline: none;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active  {
            -webkit-box-shadow: 0 0 0 30px #ffa83e inset !important;
            border: none;
        }

        #account-icon {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 86px;
        }

        .text-red { color: red; }
        a, a:hover { color: black; }
    </style>
@endpush
@section('content')
    <div class="container">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="login-card">
                <h1>Login</h1>
                @error('email')
                    <span class="text-red"><strong>Invalid username or password.</strong></span> <br>
                @enderror
                <div class="input-container">
                    <label for="">Email:</label>
                    <input type="email" name="email">
                </div>
                <div class="input-container">
                    <label for="">Password:</label>
                    <input type="password" name="password">
                </div>
                <button class="login-btn">Go</button>
                <a href="{{ route('signup') }}" class="login-btn">Sign Up</a>
                <img id="account-icon" src="{{ asset('images/account-icon.png') }}" alt="">
            </div>
        </form>
    </div>
    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
        </form> --}}
@endsection
