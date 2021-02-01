@extends('layouts.app')
@push('custom-css')
    <style>
        * {
            
        }

        body {
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

        #submit-answers {
            color: white;
            background-color: #0f3057;
            padding: 13px;
            border-radius: 7px;
            border: none;
        }
    </style>
@endpush
@section('content')
    <form id="quiz-form" action="{{ route('story.submit.answers', $story->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="paper top-shadow bottom-shadow">
            <strong>Basahing mabuti ang bawat tanong. I-click ang bilog sa tabi ng tamang sagot. </strong>
            <hr>
            @foreach($questions as $q)
                <div class="q">
                    {{ $loop->index + 1 }}.) {!! $q->question !!}
                    @foreach($q->MultipleChoices as $c)
                        <div class="form-check d-flex">
                            <div class="d-flex justify-content-center align-items-center" style="min-width: 28px;">
                                <input class="form-check-input" type="radio" name="answer[{{ $q->id }}]" id="exampleRadios1" value="{{ $c->id }}" required>
                            </div>
                            <div>
                                <span class="f-sofia fsize-small">{{ $c->answer }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
            @endforeach
        </div>
        <div class="bottom-nav">
            <div class="container">
                <div class="left d-flex">
                    <div>
                        <h3 id="timer">00:00:00</h3>
                        <input type="hidden" id="timer-input" name="time">
                    </div>
                    {{-- <div class="ml-5">
                        <h3>0/2 Answered</h3>
                    </div> --}}
                </div>
                <div class="right d-flex justify-content-end">
                    <button type="submit" id="submit-answers">
                        Ipasa ang Sagot 
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('custom-js')
    <script>
        let quizform = $('#quiz-form')
        let formsubmitbutton = $('#submitanswers')
        let submit_button = $('#submit-answers')

        submit_button.click(function(e){
            e.preventDefault()
            formsubmitbutton.click();
        });

        $(document).ready(function(){
            let hr = 0,
                mins = 0,
                sec = 0;

            setInterval(function(){

                sec += 1;
                if( sec > 59 ){
                    sec = 0;
                    mins += 1;
                }

                if( mins > 59 ){
                    mins = 0;
                    hr = 0;
                }

                let hour = String(hr).padStart(2,0)
                    minutes = String(mins).padStart(2,0)
                    seconds = String(sec).padStart(2,0);
                
                $('#timer').html(`${hour}:${minutes}:${seconds}`);
                $('#timer-input').val(`${hour}:${minutes}:${seconds}`);

            }, 1000);
        });
    </script>
@endpush