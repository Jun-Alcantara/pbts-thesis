@extends('console.layout')

@push('custom-css')
    <style>
        
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if( session()->has('task-updated') )
                <div class="alert alert-success">
                    <i class="fa fa-check"></i> Tasks updated.
                </div>
                @endif
                <form action="{{ route('task.update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>Edit Task Form</h3>
                    <div class="form-group">
                        <textarea id="tinyMCE" name="tasks" rows="30">{!! $tasks->tasks ?? null !!}</textarea>
                    </div>
                    <div class="form-group float-right">
                        <button href="#" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Tasks
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
    
    </script>
@endpush