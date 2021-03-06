@extends('layouts.app')
@push('custom-css')
    <style>
        body {
            background-color: #3c5269;
        }

        #app {
            background: #f5b9fa;
        }

        #main {
            width: 100%;
            display: flex;
        }

        #sidenav {
            background-color: white;
            flex-basis: 30%;
            padding: 10px;
            display: flex;
            flex-direction: column;
            border: 2px solid #c7753d;
        }

        .user-info {
            display: flex;
            border: 2px solid #c7753d;
        } 

        .user-info--name {
            display: flex;
            align-items: center;
        }

        .sidenav--menu {
            border: 2px solid #c7753d;
            margin-top: 15px;
            border-radius: 23px;
            flex: 1;
        }

        .sidenav--menu > ul {
            list-style: none;
            font-size: 20px;
        }

        .sidenav--menu > ul > li {
            margin: 20px;
        }

        .sidenav--menu > ul > li.active {
            font-weight: 600;
            color: #c7753d;
        }

        #banner {
            flex-basis: 70%;
            padding-left: 30px;
            padding-right: 30px;
        }

        @media only screen and (max-width: 991px) { 
            #main {
                flex-direction: column;
            }

            #sidenav {
                margin-bottom: 40px;
            }

            #banner {
                min-height: 364px;
            }
        }

        @media only screen and (max-width: 600px) { 
            #banner {
                padding-left: 0;
                padding-right: 0;
            }
        }

        a {
            color: black;
        }

        a:hover, a:focus {
            text-decoration: none;  
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
            display: block;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active  {
            -webkit-box-shadow: 0 0 0 30px #ffa83e inset !important;
            border: none;
        }

        select {
            width: 100%;
            border: none;
            background: transparent !important;
        }

        option {
            background-color: #ffa83e;
        }
    </style>
@endpush
@section('content')
    <div id="main">
        <div id="sidenav">
            <div class="user-info">
                <div class="user-info--avatar">
                    <img src="{{ asset('images/account-icon.png') }}" alt="" class="">
                </div>
                <div class="user-info--name">
                    {{ \Auth::user()->name }}
                    <br>
                    Grade {{ \Auth::user()->grade }} - Section {{ \Auth::user()->section }}
                </div>
            </div>
            <div class="sidenav--menu">
                <ul>
                    <li><strong>Language:</strong> Tagalog</li>
                    <li><a href="{{ route('library') }}">Library</a></li>
                    <li><a href="{{ route('task') }}">Task</a></li>
                    <li><a href="{{ route('stars') }}">Star</a></li>
                    <li><a href="{{ route('settings') }}" class="active">Settings</a></li>
                    <li><a href="{{ route('about') }}" target="_blank">About Us</a></li>
                    <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>  
        </div>
        <div id="banner">
            <form action="{{ route('profile.update') }}" method="POST" autocomplete="off">
                @csrf
                <div class="login-card">
                    @if( session()->has('user_updated') )
                    <div class="alert alert-success" role="alert">
                        User updated successfully
                    </div>
                    @endif
                    <div class="input-container">
                        <label for="">Name:</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="input-container">
                        <label for="">Grade:</label>
                        <select name="grade" id="grade">
                            <option value="">-- Select Grade --</option>
                            @for($g = 1; $g <= 6; $g++)
                                <option value="{{ $g }}" {{ ($g == old('grade', $user->grade)) ? 'selected' : '' }}>Grade {{ $g }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="input-container">
                        <label for="">Section:</label>
                        {{-- <input type="email" name="email"> --}}
                        <select name="section" id="section">
                            <option value="">-- Select Section --</option>
                            @for($s = 1; $s <= 6; $s++)
                                <option value="{{ $s }}" {{ ($s == old('section', $user->section)) ? 'selected' : '' }}>Section {{ $s }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="input-container">
                        <label for="">Email:</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                    <hr>
                    <label for=""> <i class="fa fa-info-circle"></i> Leave blank if you don't want to change your current password</label>
                    @if( $errors->has('password') )
                        <label class="text-danger"> <i class="fa fa-times-circle"></i> {{ $errors->first('password') }}</label>
                    @endif
                    <div class="input-container">
                        <label for="">New Password:</label>
                        <input type="password" name="password" autocomplete="off">
                    </div>
                    <div class="input-container">
                        <label for="">Confirm New Password:</label>
                        <input type="password" name="password_confirmation" autocomplete="off">
                    </div>
                    <br>
                    <button id="update-btn" class="login-btn">Save Updates</button>
                    <br><br>
                </div>
            </form>
        </div>
    </div>
@endsection