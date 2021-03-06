@extends('layouts.main')
@push('custom-css')
    <style>
        body {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-items: center;
            align-items: center;
        }

        .container {
            max-width: 800px;
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

        select {
            width: 100%;
            border: none;
            background: transparent !important;
        }

        option {
            background-color: #ffa83e;
        }

        .__inline {
            width: 49.5%;
            display: inline-block;
        }

        .login-btn { cursor: pointer; }

        .text-red { color: red; }
        a, a:hover { color: black; }

        @media only screen and (max-width: 600px) {
            body {
                display: block;
                margin-top: 40px;
            }

            .__inline {
                display: block;
                width: 100% !important;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <form id="signup-form" action="{{ route('signup.submit') }}" method="POST" autocomplete=false>
            <input autocomplete="false" name="hidden" type="text" style="display:none;">
            @csrf
            <div class="login-card">
                <div class="input-container">
                    <label for="">Name:</label>
                    <input type="text" name="name" value="{{ old('email') }}" required>
                </div>
                <div class="input-container __inline">
                    <label for="">Grade:</label>
                    <select name="grade" id="grade" required>
                        @for($g = 1; $g < 6; $g++)
                            <option value="{{ $g }}">Grade {{ $g }}</option>
                        @endfor
                    </select>
                </div>
                <div class="input-container __inline">
                    <label for="">Section:</label>
                    <select name="section" id="section" required>
                        @for($s = 1; $s < 6; $s++)
                            <option value="{{ $s }}">Section {{ $s }}</option>
                        @endfor
                    </select>
                </div>
                <div class="input-container">
                    <label for="">
                        Email: 
                        @if( $errors->has('email') )
                            <span class="text-red">(This email has been already take)</span>
                        @endif
                    </label>
                    <input type="email" name="email" value="{{ old('email', "   ") }}" autocomplete="off" required>
                </div>
                <div class="input-container">
                    <label for="">Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-container">
                    <label for="">Confirm Password:</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <a id="signup-btn" class="login-btn">Sign Up</a>
                <a href="{{ route('login') }}" class="login-btn">Login</a>
                <img id="account-icon" src="{{ asset('images/account-icon.png') }}" alt="">
            </div>
        </form>
    </div>
@endsection
@push('custom-js')
    <script>
        let loginBtn = $('#signup-btn')

        loginBtn.click(function(e){
            e.preventDefault();

            let pass = $('[name=password]').val()
            let confirmPass = $('[name=confirm_password]').val()

            if( pass.trim() !== confirmPass.trim() ){
                alert('Password confirmation did not matched.');
                return;
            }

            $('#signup-form').submit();
        });
    </script>
@endpush