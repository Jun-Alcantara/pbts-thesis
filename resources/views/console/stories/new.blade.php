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
                <form action="{{ route('stories.save') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>New Story Form</h3>
                    <hr>
                    <div class="form-group">
                        <label for="title" class="required">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Story</label>
                        <textarea id="tinyMCE" name="body" rows="30"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Audio</label>
                        <input type="file" class="" name="recording" accept="mp3" required/>
                    </div>
                    <div class="form-group">
                        <label for="title" class="required">Cover</label>
                        <input type="file" class="" name="cover_photo" accept="image/x-png,image/gif,image/jpeg" required/>
                    </div>
                    <hr>
                    <div id="questions-container"></div>
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
                <div id="question${index}" class="question well well-sm">
                    <label for="title" class="required question-label">Question</label>
                    <a href="#" class="float-right remove-question-btn" data-target="#question${index}">
                        [Remove]
                    </a>
                    <input type="text" class="form-control" name="question[${index}][question]" value="{{ old('title') }}" required>
                    <br>
                    <label for="Choices">Choices</label>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 1">
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="1" style="right: 21px; top: 7px;" checked>
                    </div>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 2">
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="2" style="right: 21px; top: 7px;">
                    </div>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 3">
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="3" style="right: 21px; top: 7px;">
                    </div>
                    <div class="position-relative">
                        <input type="text" class="form-control" name="question[${index}][choices][]" placeholder="Answer 4">
                        <input type="radio" class="position-absolute" name="question[${index}][correct]" value="4" style="right: 21px; top: 7px;">
                    </div>
                </div>
            `;

            container.append(template)
            updateLabels()
        });

        // <textarea cols="30" rows="5" class="form-control" name="question[${index}][choices]" placeholder="List multiple choices separated by a new line"></textarea>

        $(document).on("click", ".remove-question-btn", function(e){
            e.preventDefault();
            $( $(this).data('target') ).remove()
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