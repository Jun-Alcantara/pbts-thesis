@extends('layouts.main')
@push('custom-css')
    <style>
        body {
            background-color: #3c5269;
        }

        div.container {
            margin-top: 40px;
            border: 5px solid #bc7d2c;
            border-radius: 7px;
            padding: 40px;
            background-color: #e09d47;
            position: relative;
            min-height: 200px;
        }

        #close-btn {
            position: absolute;
            top: -27px;
            right: 2px;
            padding: 5px;
            -webkit-text-stroke: 3px #c7753d;
            color: black;
        }

        #book-icon {
            position: absolute;
            top: -44px;
            left: -31px;
            z-index: 1;
            transform: rotate(-28deg);
        }

        .card {
            width: 100%;
            border: 5px solid #bc7d2c;
            border-radius: 30px;
            background-color: #e1c7dd;
            padding: 10px 250px;
        }

        .sil-item {
            display: flex;
            margin-bottom: 20px;
        }

        .sil-item > div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .sil-item > .star-icon {
            margin-right: 10px;
        }

        @media only screen and (max-width: 1200px){
            .card {
                padding: 10px 50px;
            }
        }

        @media only screen and (max-width: 768px){
            body {
                padding: 10px;
            }

            #book-icon {
                position: absolute;
                top: -44px;
                left: -31px;
                z-index: 1;
                width: 170px;
                height: auto;
            }

            .card {
                padding: 10px 10px;
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
        <div class="card">
            {{-- <h1 class="text-center mb-5">Mga Takdang-Aralin</h1>
            <div class="star-icon-list">
                <div class="sil-item">
                    <div class="star-icon">
                        <img src="{{ asset('images/star-icon.png') }}" alt="">
                    </div>
                    <div class="text">
                        Basahing ang unang pangungusap nang kwentong "Ang Mabain na Kalabaw"
                    </div>
                </div>
                <div class="sil-item">
                    <div class="star-icon">
                        <img src="{{ asset('images/star-icon.png') }}" alt="">
                    </div>
                    <div class="text">
                        Basahing ang unang pangungusap nang kwentong "Ang Kapuri-puring Kuting"
                    </div>
                </div>
                <div class="sil-item">
                    <div class="star-icon">
                        <img src="{{ asset('images/star-icon.png') }}" alt="">
                    </div>
                    <div class="text">
                        Basahin at matuto sa librong "Ang AKing Abakada"
                    </div>
                </div>
            </div> --}}
            <h1 class="text-center mb-5">Mga Takdang-Aralin</h1>
            {!! $tasks->tasks ?? null !!}
        </div>
    </div>
@endsection