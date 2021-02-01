@extends('console.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            {{ csrf_field() }}
                            <h3>Edit User Form</h3>
                            <hr>
                            
                            @if( session()->has('existing_email') )
                                <div class="alert alert-danger">
                                    <i class="fa fa-times-circle"></i> Email is already been taken.
                                </div>
                            @endif

                            @if( session()->has('success') )
                                <div class="alert alert-success">
                                    <i class="fa fa-times-circle"></i> User details updated!
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old("name", $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old("email", $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select name="grade" id="grade" class="form-control" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="1" {{ ( $user->grade == "1" ? "selected" : "" ) }}>Grade 1</option>
                                    <option value="2" {{ ( $user->grade == "2" ? "selected" : "" ) }}>Grade 2</option>
                                    <option value="3" {{ ( $user->grade == "3" ? "selected" : "" ) }}>Grade 3</option>
                                    <option value="4" {{ ( $user->grade == "4" ? "selected" : "" ) }}>Grade 4</option>
                                    <option value="5" {{ ( $user->grade == "5" ? "selected" : "" ) }}>Grade 5</option>
                                    <option value="6" {{ ( $user->grade == "6" ? "selected" : "" ) }}>Grade 6</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select name="section" id="section" class="form-control" required>
                                    <option value="">-- Select Section --</option>
                                    <option value="1" {{ ($user->section == "1") ? "selected" : "" }}>Section 1</option>
                                    <option value="2" {{ ($user->section == "2") ? "selected" : "" }}>Section 2</option>
                                    <option value="3" {{ ($user->section == "3") ? "selected" : "" }}>Section 3</option>
                                    <option value="4" {{ ($user->section == "4") ? "selected" : "" }}>Section 4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="float-right">
                                    <a href="{{ route('users.list') }}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> &nbsp; User list
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> &nbsp; Save Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection