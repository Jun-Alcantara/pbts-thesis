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
            background-attachment: fixed
        }

        .bottom-nav {
            width: 100%;
            padding: 10px;
            position: fixed;
            bottom: 0;
            left: 0;
            background: url("{{ asset('images/halaman.jpg') }}");
            background-position: bottom;
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
    <form id="quiz-form" action="{{ route('story.submit.answers', $story->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="paper top-shadow bottom-shadow">
            <strong>Basahing mabuti ang bawat tanong. I-click ang bilog sa tabi ng tamang sagot. </strong>
            <hr>
            @foreach($questions as $q)
                <div class="q">
                    {{ $loop->index + 1 }}.) {!! $q->question !!}
                    @php $choices = optional( $q->MultipleChoices ) @endphp
                    @foreach($choices->all() as $c)
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
    @include('components.instructions', [
        'instructions' => 'Basahin mabuti ang kwento. I-click ang play button sa ibabang bahagi ng pahinang ito para mapakinggan ang kwento. I-click ang kalapit ng button para ulitin ang kwento.',
        'display_on_load' => true,
        'page' => 'quiz'
    ])
@endsection
@push('custom-js')
    <script>
        let quizform = $('#quiz-form')
        let formsubmitbutton = $('#submitanswers')
        let submit_button = $('#submit-answers')

        submit_button.click(function(e){
            e.preventDefault()
            console.log("TEST");
            quizform.submit();
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