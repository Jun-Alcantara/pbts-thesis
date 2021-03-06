@extends('layouts.app')
@push('custom-css')
    <style>
        * {
            
        }

        body {
            padding-bottom: 90px;
            background-color: #334a62;
            background: url("{{ asset('images/conversation.jpg') }}");
            background-size: cover;
            background-attachment: fixed;
            padding-bottom: 90px;
        }

        .bottom-nav {
            width: 100%;
            padding: 10px;
            background-color: white;
            position: fixed;
            bottom: 0;
            left: 0;
        }

        .bottom-nav > .container {
            display: flex;
        }

        .paper > span {
            line-height: 30px;
        }

        .container > .right {
            flex-grow: 1;
        }

        .submit-answers {
            color: white;
            background-color: #0f3057;
            padding: 13px;
            border-radius: 7px;
            border: none;
        }

        .text-yellow { color: #de9000; }

        .bottom-nav {
            background: url("{{ asset('images/halaman.jpg') }}");
            background-position: bottom;
        }
        
        @media only screen and (max-width: 768px){
            .paper {
                padding: 41px 16px;
            }

            .paper {
                margin: 25px 10px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="paper top-shadow bottom-shadow">
        <h1 class="text-center">About Us</h1>
        <p class="text-justify">
            {!! $aboutus ?? "We will writing something about us soon" !!}
        </p>
    </div>
@endsection