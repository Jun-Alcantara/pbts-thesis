@extends('layouts.app')
@push('custom-css')
    <style>
        * {
            margin: 0;
        }

        .story-thumbnail {
            display: flex;
            justify-content: center;
        }

        .profile {
            margin-top: 20px;
            padding: 20px 10px;
            background-color: #c7753d;
            text-align: center;
            color: white;
            /** border: 5px solid #; **/
        }

        .profile > h3 {
            margin: 0 !important;
        }
    </style>
@endpush
@section('content')
    <div style="display: flex;">
        <div class="girl">
            <img src="{{ asset('images/Bata.png') }}">
        </div>
        <div class="talk-bubble tri-right left-top">
            <div class="talktext">
                <p>Select a story to start.</p>
            </div>
        </div>
    </div>
    <div class="d-flex container-fluid mb-3">
        <div class="profile col-lg-4 col-sm-12">
            <h3>Jun Alcantara</h3>
            <h5>Grade 5 - Section 1</h5>
        </div>
    </div>
    <div id="story-items-container" class="d-flex justify-content-around flex-wrap">
        @foreach($stories as $story)
            <div class="text-center">
                <div class="story-thumbnail">
                    <img class="image-fluid" src="{{ url( Storage::url( $story->cover_photo ) ) }}" alt="">
                    {{-- <img src="http://via.placeholder.com/600x150"> --}}
                </div>
                <div>
                    <div class="story-title-container">
                        <h4 class="text-center">{{ $story->title }}</h4>
                    </div>
                    <a href="#" class="btn btn-primary text-center">Basahin</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection