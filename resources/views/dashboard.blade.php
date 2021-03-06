@extends('layouts.app')
@push('custom-css')
    <style>
        body {
            background: #3c5269;
        }

        #app {
            background: #83b9bb;
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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media only screen and (max-width: 991px) { 
            #main {
                flex-direction: column-reverse;
            }

            #banner {
                max-height: 364px;
            }
        }

        a {
            color: black;
        }

        a:hover, a:focus {
            text-decoration: none;  
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
                    <li><a href="{{ route('settings') }}">Settings</a></li>
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
            <img src="{{ asset('images/homebook-icon.png') }}" alt="">
        </div>
    </div>
@endsection