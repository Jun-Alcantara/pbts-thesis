@extends('console.layout')

@push('custom-css')
    <style>

    </style>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if( session()->has('aboutus-updated') )
                <div class="alert alert-success">
                    <i class="fa fa-check"></i> About us updated.
                </div>
                @endif
                <form action="{{ route('aboutus.update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h3>Edit About Us Form</h3>
                    <div class="form-group">
                        <textarea id="tinyMCE" name="aboutus" rows="30">{!! $aboutus ?? null !!}</textarea>
                    </div>
                    <div class="form-group float-right">
                        <button href="#" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update About Us
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