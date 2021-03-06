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

        .story-thumbnail {
            width: 100px !important;
            height: 100px !important;
        }

        .story-thumbnail > img {
            max-height: 100%;
            max-width: 100%;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
        }

        .story-result > h3 {
            margin-top: 0;
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
            <div class="results">
                @foreach($results as $r)
                    <div class="result-item d-flex mb-3">
                        <div class="story-thumbnail mr-2">
                            <img class="thumbnail" src="{{ url( Storage::url($r['cover_photo']) ) }}">
                        </div>
                        <div class="story-result">
                            <h3>{{ $r['title'] }}</h3>
                            <h5> 
                                <i class="fa fa-calendar"></i> Date Taken: {{ date('F d, Y', strtotime($r['created_at'])) }} <br>
                                <i class="fa fa-star"></i> Score: {{ $r['points'] }}/{{ $r['total_questions'] }}
                            </h5> 
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection