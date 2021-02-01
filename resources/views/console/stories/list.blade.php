@extends('console.layout')

{{-- @push('custom-css')
    <style>
        .float-right {
            float: right;
        }

        table {
            margin-top: 20px;
        }
    </style>
@endpush --}}

@section('content')
    <div class="container">
        <div class="controls">
            <a href="{{ route('stories.new') }}" class="btn btn-primary float-right" style="margin-top: 9px;">
                <i class="fa fa-plus-circle"></i> Create new story
            </a>
            <h3 class="float-left">Story List</h3>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if( isset( $stories ) )
                    @forelse($stories as $story)
                        <tr>
                            <td>{{ $story->title ?? "" }}</td>
                            <td>{{ $story->author ?? "" }}</td>
                            <td>
                            <a href="{{ route('stories.edit', $story->id) }}" type="button" class="btn btn-primary btn-xs"><i href="" class="fa fa-edit"></i></a>
                            <a href="#" data-durl="{{ route('stories.delete', $story->id) }}" type="button" class="btn btn-danger btn-xs delete-story-btn"><i href="" class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3 text-center test">
                                <p class="text-center">
                                    <i>No stories found</i>
                                </p>
                            </td>
                        </tr>
                    @endforelse
                @endif
                
            </tbody>
        </table>
    </div>
@endsection
@push('custom-js')
    <script>
        $('.delete-story-btn').click(function(e){
            e.preventDefault();
            
        });
    </script>
@endpush