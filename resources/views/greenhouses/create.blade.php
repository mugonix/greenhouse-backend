@extends('layouts.main-app')

@section('page-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <a href="{{route("greenhouses.index")}}"
                           class="btn btn-sm btn-light waves-effect waves-light mr-2">Back
                        </a>
                        <span style="font-size: 18px;">Add Greenhouse</span>
                    </div>

                    <div class="card-body">
                        @include("layouts.partials.alerts")

                        <form method="post" action="{{route("greenhouses.store")}}">
                            @csrf
                            <div class="form-group row">
                                <label for="input-21" class="col-sm-2 col-form-label">User Account</label>
                                <div class="col-sm-10">
                                    <select name="user_id" class="form-control user-select-list">
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{$user->id}}">{{$user->name}}
                                                (<strong>{{$user->username}}</strong>)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-22" class="col-sm-2 col-form-label">Greenhouse Name</label>
                                <div class="col-sm-10">
                                    <input name="greenhouse_name" type="text" class="form-control" id="input-22"
                                           placeholder="Greenhouse Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-white px-5"><i class="fa fa-plus"></i> Add
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

@push("pageJavascript")
    <!--Select Plugins Js-->
    <script src="{{asset("assets/plugins/select2/js/select2.min.js")}}"></script>

    <script>
        $(document).ready(function () {
            $('.user-select-list').select2();
        });
    </script>
@endpush

@push("pageStyle")
    <!--Select Plugins-->
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet"/>
@endpush


