@extends('layouts.main-app')

@section('page-content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-cogs mr-1"></i>
                        Account Settings
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <div class="alert-icon contrast-alert">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="alert-message">
                                    <span><strong>Success!</strong> {{ session('status') }}</span>
                                </div>
                            </div>
                        @endif

                        @if(count($errors->all()) > 0)
                            @foreach($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <div class="alert-icon contrast-alert">
                                            <i class="fa fa-times"></i>
                                        </div>
                                        <div class="alert-message">
                                            <span><strong>Error!</strong> {{ $error }}</span>
                                        </div>
                                    </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::model($user,["route"=>'user.settings']) !!}

                                <div class="form-group row">
                                    <label for="username"
                                           class="col-md-2 col-form-label text-md-right">{{ __('Username') }}</label>

                                    <div class="col-md-10">
                                        {!! Form::text("username",null,["id"=>"username",
                                            "class"=>"form-control ". ($errors->has("username")?"is-invalid":""),
                                            "required", "autocomplete"=>"username",(isset($user)?"disabled":"")]) !!}

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="first_names"
                                           class="col-md-2 col-form-label text-md-right">First Name(s)</label>

                                    <div class="col-md-10">
                                        {!! Form::text("first_names",null,["id"=>"first_names",
                                            "class"=>"form-control ". ($errors->has("first_names")?"is-invalid":""),
                                            "required", "autocomplete"=>"first_names"]) !!}

                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="surname"
                                           class="col-md-2 col-form-label text-md-right">Surname</label>

                                    <div class="col-md-10">
                                        {!! Form::text("surname",null,["id"=>"surname",
                                            "class"=>"form-control ". ($errors->has("surname")?"is-invalid":""),
                                            "required", "autocomplete"=>"surname"]) !!}

                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-2 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-10">
                                        {!! Form::email("email",null,["id"=>"email",
                                            "class"=>"form-control ". ($errors->has("email")?"is-invalid":""),
                                            "required", "autocomplete"=>"email"]) !!}

                                        @error('email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="form-header">
                                    <i class="fa fa-key"></i>
                                    Update Password
                                </h4>

                                <div class="form-group row">
                                    <label for="current_password"
                                           class="col-md-2 col-form-label text-md-right">Current Password</label>

                                    <div class="col-md-10">
                                        {!! Form::password("current_password",["id"=>"current_password",
                                            "class"=>"form-control ". ($errors->has("current_password")?"is-invalid":""),
                                            "autocomplete"=>"new-password"]) !!}

                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_password"
                                           class="col-md-2 col-form-label text-md-right">New Password</label>

                                    <div class="col-md-10">
                                        {!! Form::password("new_password",["id"=>"new_password",
                                            "class"=>"form-control ". ($errors->has("new_password")?"is-invalid":""),
                                            "autocomplete"=>"new-password"]) !!}

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_password_confirmation"
                                           class="col-md-2 col-form-label text-md-right">New Password
                                        Confirmation</label>

                                    <div class="col-md-10">
                                        {!! Form::password("new_password_confirmation",["id"=>"new_password_confirmation",
                                            "class"=>"form-control ". ($errors->has("new_password_confirmation")?"is-invalid":""),
                                            "autocomplete"=>"new-password"]) !!}

                                        @error('new_password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            Update Account
                                        </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
