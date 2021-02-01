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
    {{-- <form id="quiz-form" action="{{ route('story.submit.answers', $story->id) }}" method="POST">
        {{ csrf_field() }} --}}
        <div class="paper top-shadow bottom-shadow">
            <strong>Basahing mabuti ang bawat tanong. I-click ang bilog sa tabi ng tamang sagot. </strong>
            <hr>
            @foreach($questions as $q)
                <div class="q">
                    {{ $loop->index + 1 }}.) {!! $q->question !!}
                    @foreach($q->MultipleChoices as $c)
                        <div class="form-check d-flex">
                            <div class="d-flex justify-content-center align-items-center" style="min-width: 28px;">
                                <span class="{{ ($q->user_answer == $c->id) ? "dot" : "circle" }} mr-3"></span>
                                {{-- <input class="form-check-input" type="radio" name="answer[{{ $q->id }}]" value="{{ $c->id }}" disabled {{ ($q->user_answer == $c->id) ? "checked" : "" }}> --}}
                            </div>
                            <div>
                                <span class="f-sofia fsize-small">
                                    {{ $c->answer }}
                                    @if( $c->is_correct )
                                        @if($q->user_answer == $c->id)
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-check text-success"></i>
                                        @endif
                                    @else
                                        @if($q->user_answer == $c->id)
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
            @endforeach
            <p>
                <span>
                    Puntos: {{ $result->points }} <br>
                    Tagal: {{ $result->duration }} <br>
                    Oras at Araw: {{ date('F d, Y', strtotime($result->created_at)) }}
                </span>
            </p>
        </div>
        <div class="bottom-nav">
            <div class="container">
                <div class="left d-flex">
                    <div>
                    
                    </div>
                    {{-- <div class="ml-5">
                        <h3>0/2 Answered</h3>
                    </div> --}}
                </div>
                <div class="right d-flex justify-content-end">
                    <a href="{{ route('story.read', $story->id) }}" type="submit" id="submit-answers">
                        Bumalik
                    </a>
                </div>
            </div>
        </div>
    {{-- </form> --}}
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
    </script>
@endpush