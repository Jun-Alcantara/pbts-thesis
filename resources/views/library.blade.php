@extends('layouts.main')
@push('custom-css')
    <style>
        body {
            background-color: #3c5269;
            position: relative;
        }

        a {  color: black; }

        .container {
            margin-top: 40px;
            border: 5px solid #c7753d;
            border-radius: 7px;
            padding: 40px;
            background-color: #b7a8bf;
        }

        .card {
            background-color: #d9aa83;
            border: 2px solid #bc7d2c;
            border-radius: 30px;
            width: 100%;
            padding: 40px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .card-item {
            flex-basis: 25%;
            padding: 10px;
        }

        .card-thumbnail {
            height: 150px;
            width: 100%;
            background-color: white;
            display: flex;
            border-radius: 7px;
            border: 2px solid #bc7d2c;
        }

        .card-thumbnail > img {
            object-fit: cover;
            max-width: 100%;
            min-width: 100%;
            max-height: 100%;
        }

        .card-title {
            text-align: center;

        }

        .container {
            position: relative;
        }

        #book-icon {
            position: absolute;
            top: -44px;
            left: -31px;
            z-index: 1;
            transform: rotate(-28deg);
        }

        #bata {
            position: fixed;
            bottom: 0;
            right: 0;
            z-index: 1;
            transform: scaleX(-1);
        }

        #close-btn {
            position: absolute;
            top: -27px;
            right: 2px;
            padding: 5px;
            -webkit-text-stroke: 3px #c7753d;
        }

        @media only screen and (max-width: 1000px){
            .card-item {
                flex-basis: 33%;
            }

            .card-thumbnail {
                height: 120px;
            }
        }

        @media only screen and (max-width: 768px){
            body {
                padding: 10px;
            }

            .card {
                padding: 10px;
            }

            .card-item {
                flex-basis: 50%;
            }

            .card-thumbnail {
                height: 100px;
            }

            #book-icon {
                position: absolute;
                top: -44px;
                left: -31px;
                z-index: 1;
                width: 170px;
                height: auto;
            }

            #bata {
                width: 140px;
                right: 15px;
                bottom: 15px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <img id="book-icon" src="{{ asset('images/book-icon2.png') }}" alt="">
        <a href="{{ route('dashboard') }}">
            <h1 id="close-btn">
                <i class="fa fa-times"></i>
            </h1>
        </a>
        <div class="row">
            <div class="card">
                @foreach($stories as $story)
                    <div class="card-item">
                        <div class="card-thumbnail">
                            {{-- <img src="{{ asset('images/halaman.jpg') }}" alt=""> --}}
                            <img src="{{ url( Storage::url( $story->cover_photo ) ) }}" alt="">
                        </div>
                        <div class="card-title">
                            <a href="{{ route('story.read', $story->id) }}">{{ $story->title }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <a href="#" class="show-instructions btn btn-primary mt-3 w-100">Basahin ang mga tagubilin</a> --}}
        </div>
    </div>
    <img id="bata" src="{{ asset('images/bata.png') }}" alt="">
    {{-- @include('components.instructions', [
        'instructions' => 'testateststes'
    ]) --}}
@endsection