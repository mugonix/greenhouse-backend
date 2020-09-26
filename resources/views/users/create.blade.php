@extends('layouts.main-app')

@section('page-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{route("user-management.index")}}"
                           class="float-left btn btn-sm btn-secondary mr-4">Back</a>
                        Add User
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
                                <form method="POST" action="{{ route('user-management.store') }}">
                                    @csrf

                                    @include("users.form")

                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-2 col-form-label text-md-right">Password</label>

                                        <div class="col-md-10">
                                            {!! Form::password("password",["id"=>"password",
                                                "class"=>"form-control ". ($errors->has("password")?"is-invalid":""),
                                                "required", "autocomplete"=>"new-password"]) !!}

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-10">
                                            {!! Form::password("password_confirmation",["id"=>"password-confirm",
                                                "class"=>"form-control ". ($errors->has("password_confirmation")?"is-invalid":""),
                                                "required", "autocomplete"=>"new-password"]) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Add User
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
