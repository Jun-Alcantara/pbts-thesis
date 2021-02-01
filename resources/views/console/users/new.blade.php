@extends('console.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.save') }}" method="POST">
                            {{ csrf_field() }}
                            <h3>New User Form</h3>
                            <hr>
                            
                            @if( session()->has('existing_email') )
                            <div class="alert alert-danger">
                                <i class="fa fa-times-circle"></i> Email is already been taken.
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old("name", "") }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old("email", "") }}" required>
                            </div>
                            <div class="form-group">
                                <label for="grade">Grade</label>
                                <select name="grade" id="grade" class="form-control" required>
                                    <option value="">-- Select Grade --</option>
                                    <option value="1" {{ ( old("grade") == 1 ? "selected" : "" ) }}>Grade 1</option>
                                    <option value="2" {{ ( old("grade") == 2 ? "selected" : "" ) }}>Grade 2</option>
                                    <option value="3" {{ ( old("grade") == 3 ? "selected" : "" ) }}>Grade 3</option>
                                    <option value="4" {{ ( old("grade") == 4 ? "selected" : "" ) }}>Grade 4</option>
                                    <option value="5" {{ ( old("grade") == 5 ? "selected" : "" ) }}>Grade 5</option>
                                    <option value="6" {{ ( old("grade") == 6 ? "selected" : "" ) }}>Grade 6</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <select name="section" id="section" class="form-control" required>
                                    <option value="">-- Select Section --</option>
                                    <option value="1" {{ (old("section") == "1") ? "selected" : "" }}>Section 1</option>
                                    <option value="2" {{ (old("section") == "2") ? "selected" : "" }}>Section 2</option>
                                    <option value="3" {{ (old("section") == "3") ? "selected" : "" }}>Section 3</option>
                                    <option value="4" {{ (old("section") == "4") ? "selected" : "" }}>Section 4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="float-right">
                                    <a href="{{ route('users.list') }}" class="btn btn-default">
                                        <i class="fa fa-arrow-left"></i> &nbsp; User list
                                    </a>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-save"></i> &nbsp; Save
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