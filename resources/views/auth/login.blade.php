@extends('layouts.app')

@section('pageTitle', "Sign In")

@section('content')
    <div class="loader-wrapper">
        <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="card card-authentication1 mx-auto my-5">
        <div class="card-body">
            <div class="card-content p-2">
                <div class="text-center">
                    <img src="{{asset('/assets/images/smart-farm.png')}}" height="120" alt="logo icon">
                </div>
                <div class="card-title text-uppercase text-center py-3">Sign In</div>
                @include("layouts.partials.alerts")
                <form method="post" action="{{route("login")}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername" class="sr-only">Username</label>
                        <div class="position-relative has-icon-right">
                            <input name="username" type="text" id="exampleInputUsername"
                                   class="form-control input-shadow"
                                   placeholder="Enter Username">
                            <div class="form-control-position">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword" class="sr-only">Password</label>
                        <div class="position-relative has-icon-right">
                            <input name="password" type="password" id="exampleInputPassword"
                                   class="form-control input-shadow"
                                   placeholder="Enter Password">
                            <div class="form-control-position">
                                <i class="icon-lock"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <div class="icheck-material-white">
                                <input type="checkbox" id="user-checkbox" checked=""/>
                                <label for="user-checkbox">Remember me</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-light btn-block">Sign In</button>
                </form>
            </div>
        </div>
        <div class="card-footer text-center py-3">
            {{--            <p class="text-warning mb-0">Do not have an account? <a href="authentication-signup.html"> Sign Up here</a>--}}
            {{--            </p>--}}
        </div>
    </div>
@endsection
