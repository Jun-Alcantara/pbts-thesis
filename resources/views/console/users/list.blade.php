@extends('console.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="w-100">
                    <a href="{{ route('users.new') }}" class="btn btn-primary float-right" style="margin-top: 9px;">
                        <i class="fa fa-user-plus"></i> Create new user
                    </a>
                    <h3 class="float-left">User List</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if( isset($message) )
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( isset($users) && !empty($users) )
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td style="max-width: 150px;">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#" data-durl="{{ route('users.delete', $user->id) }}" class="btn btn-danger btn-xs delete-user-btn">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">No Users</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('custom-js')
    <script>
        let deleteUserBtn = $('.delete-user-btn')

        @if( session()->has('d') )
            swal("User deleted!", {
                icon: "success",
            });
        @endif  

        deleteUserBtn.click(function(e){
            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover the details of this user!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).html(`<i class="fa fa-spinner fa-spin"></i> deleting user ...`);
                    window.location.href = $(this).data('durl');
                } else {
                    $(this).html(`<i class="fa fa-trash"></i>`);
                }
            });
        });
    </script>
@endpush