@extends('layouts.app')
@push('custom-css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sofia&display=swap');
        
        body {
            padding-bottom: 90px;
        }

        .bottom-nav {
            width: 100%;
            padding: 10px;
            background-color: white;
            position: fixed;
            bottom: 0;
        }

        .bottom-nav > .container {
            display: flex;
        }

        .bottom-nav--right {
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .start-quiz {
            color: white;
            background-color: #0f3057;
            padding: 13px;
            border-radius: 7px;
        }

        .start-quiz:hover {
            text-decoration: none;
        }
    </style>
@endpush
@section('content')
    <div class="paper top-shadow bottom-shadow f-sofia">
        <h2 class="text-center">{{ $story->title }}</h2>
        {!! $story->body !!}
    </div>
@endsection
@push('bottom-nav')
    <div class="bottom-nav">
        <div class="container">
            <div class="bottom-nav--left">
                <div id="audio-play-pause-btn" class="btn play">
                    <span class="bar bar-1"></span>
                    <span class="bar bar-2"></span>				
                </div>
                <audio id="audio-player" class="d-none" controls>
                    <source src="{{ url( Storage::url($story->audio) ) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <div class="bottom-nav--right">
                <a href="{{ route('story.selection') }}" class="start-quiz mr-3">
                    Bumalik
                </a>
                @if(isset($quiz_status) && $quiz_status == "done")
                    <a href="{{ route('story.quiz.result', $story->id) }}" class="start-quiz">
                        Tignan ang Resulta
                    </a>
                @else
                    <a href="{{ route('story.quiz', $story->id) }}" class="start-quiz">
                        Magsimula sa Pagsusulit
                    </a>
                @endif
            </div>
        </div>
    </div>
@endpush
@push('custom-js')
    <script>
        $('body').on('click', '.__btn', function(e){
            e.preventDefault();
            if ( $(this).hasClass('play') ) {
                $(this).removeClass('play');
                $(this).addClass('pause');
            } else {
                $(this).removeClass('pause');
                $(this).addClass('play');
            }
        });

        let isAudioPlaying = false;
        let player = document.getElementById("audio-player");

        $('#audio-play-pause-btn').click(function(e){
            if( isAudioPlaying ){
                // Pause
                isAudioPlaying = false;
                player.pause();
            }else{
                // Play
                isAudioPlaying = true;
                player.play();
            }
        });
    </script>
@endpush