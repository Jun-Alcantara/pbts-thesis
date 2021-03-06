@extends('layouts.main')
@push('custom-css')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&display=swap" rel="stylesheet">
    <style>
        body {
            background: url("{{ asset('images/halaman.jpg') }}");
            background-attachment: fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .content {
            display: flex;
            
        }

        .content > div {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        h1.start-learning  {
            font-size: 90px;
            font-family: 'Akaya Kanadaka', cursive;
            font-weight: 900;
            color: black;
            -webkit-text-fill-color: pink; /* Will override color (regardless of order) */
            -webkit-text-stroke-width: 1px;
            -webkit-text-stroke-color: black;
            transition: 0.3s ease all;
        }

        h1.start-learning:hover {
            transform: scale(1.1);
        }

        @media only screen and (max-width: 1300px) {
            .content > div > img {
                width: 100%;
                height: auto;
            }
        }

        @media only screen and (max-width: 900px) {
            .content {
                flex-direction: column;
                justify-content: space-between;
                width: 100%;
            }

            .content > div > img {
                height: 400px;
                width: auto;
            }
        }

        @media only screen and (max-width: 600px) {
            h1.start-learning  {
                font-size: 70px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="content">
        <div class="logo-contianer">
            <img id="logo" class="animate__animated animate__bounce animate__infinite	infinite" src="{{ asset('images/homepage2-with-text.png') }}">
        </div>
        <div class="start-learning-contianer text-center">
            {{-- <a href="{{ route('dashboard') }}"><img id="start-learning" src="{{ asset('images/start-learning.png') }}" alt=""></a> --}}
            <a href="{{ route('dashboard') }}"><h1 class="start-learning animate__backInUp">Start <br> Learning</h1></a>
        </div>
    </div>
@endsection