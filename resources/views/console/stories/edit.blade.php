@extends('console.layout')

@push('custom-css')
    <style>
        div.question {
            margin-bottom: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('stories.update', $story->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>Edit Story Form</h3>
                    <hr>
                    <div class="form-group">
                        <label for="title" class="required">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $story->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Story</label>
                        <textarea id="tinyMCE" name="body" rows="30">{!! $story->body !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Audio</label>
                        <input type="file" class="" name="recording">
                    </div>
                    @if( $story->audio )
                    <audio controls>
                        <source src="{{ url( Storage::url($story->audio) ) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    @endif
                    <div class="form-group">
                        <label for="title" class="required">Cover</label>
                        <input type="file" class="" name="cover_photo" accept="image/x-png,image/gif,image/jpeg"/>
                    </div>
                    @if( $story->cover_photo )
                    <div>
                        <img src="{{ url( Storage::url($story->cover_photo) ) }}" alt="" class="img-thumbnail" style="max-width: 500px;">
                    </div>
                    @endif
                    <hr>
                    <div id="questions-container">
                        @foreach($story->Questions as $q)
                            @php $index = uniqid(); @endphp
                            <div id="question{{ $index }}" class="question well well-sm">
                                <label for="title" class="required question-label">Question {{ $loop->index + 1 }}</label>
                                <a href="#" class="float-right remove-question-btn" data-target="#question{{ $index }}">
                                    [Remove]
                                </a>
                                <input type="text" class="form-control" name="question[{{ $index }}][question]" value="{{ old('title', $q->question) }}" required>
                                <input type="hidden" name="question[{{ $index }}][question_id]" value="{{ old('title', $q->id) }}">
                                <input class="removed" type="hidden" name="question[{{ $index }}][removed]" value="no">
                                <br>
                                <label for="Choices">Choices</label>
                                @foreach($q->MultipleChoices as $c)
                                    <div class="position-relative">
                                        <input type="text" class="form-control" name="question[{{ $index }}][choices][{{ $c->id }}]" value="{{ $c->answer }}" placeholder="Answer 1">
                                        <input type="radio" class="position-absolute" name="question[{{ $index }}][correct]" value="{{ $loop->index + 1 }}" style="right: 21px; top: 7px;" {{ ($c->is_correct) ? "checked" : "" }}>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <a href="#" id="add-story-btn" class="btn btn-primary">
                            Add Question
                        </a>
                    </div>
                    <div class="form-group float-right">
                        <a href="{{ route('stories.list') }}" class="btn">
                            <i class="fa fa-arrow-left"></i> Story List
                        </a>
                        <button href="#" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Story
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        $('#add-story-btn').click(function(e){

            e.preventDefault();

            var n = Math.floor(Math.random() * 11);
            var index = Math.floor(Math.random() * 1000000);

            let container = $('#questions-container')

            let template = `
                <div id="question${index}" class="question well well-sm added">
                    <label for="title" class="required question-label">Question</label>
                    <a href="#" class="float-right remove-question-btn" data-target="#question${index}">
                        [Remove]
                    </a>
                    <input type="text" class="form-control" name="question[${index}][question]" value="{{ old('title') }}" required>
                    <br>
                    <label for="Choices">Choices</label>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 1" required>
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="1" style="right: 21px; top: 7px;" checked>
                    </div>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 2" required>
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="2" style="right: 21px; top: 7px;">
                    </div>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 3" required>
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="3" style="right: 21px; top: 7px;">
                    </div>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 4" required>
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="4" style="right: 21px; top: 7px;">
                    </div>
                </div>
            `;

            container.append(template)
            updateLabels()
        });

        $(document).on("click", ".remove-question-btn", function(e){
            e.preventDefault();

            if( $( $(this).data('target') ).hasClass("added") ){
                $( $(this).data('target') ).remove()
            }else{
                $( $(this).data('target') ).hide()
            }
            
            $( $(this).data('target') + " > .question-label" ).removeClass("question-label")
            $( $(this).data('target') + " > .removed" ).val("yes")

            updateLabels()
        });

        function updateLabels(){
            let qLabels = $('.question-label');
            qLabels.each((index, el) => {
                $(el).html(`Question ${index + 1}`);
            });
        }
    </script>
@endpush