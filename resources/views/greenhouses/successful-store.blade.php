@extends('layouts.main-app')

@section('page-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">

                    <div class="card-header">
                        <span style="font-size: 18px;">Greenhouse Added!</span>
                    </div>

                    <div class="card-body">
                        @include("layouts.partials.alerts")

                        <h3>Greenhouse has been successfully provisioned!</h3>
                        <p>Take note of the Greenhouse details, the API key is secret and wont appear again, it must be
                            added to the node.</p>
                        <form class="mt-3">
                            <div class="form-group row">
                                <label for="input-21" class="col-sm-4 col-form-label">User Account</label>
                                <div class="col-sm-8">
                                    {{$greenhouse->owner->name}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-22" class="col-sm-4 col-form-label">Greenhouse Name</label>
                                <div class="col-sm-8">
                                    {{$greenhouse->name}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-22" class="col-sm-4 col-form-label">Greenhouse Code</label>
                                <div class="col-sm-8">
                                    {{$greenhouse->code}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-22" class="col-sm-4 col-form-label">API Key</label>
                                <div class="col-sm-8">
                                    {{$greenhouse->api_token}}
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">
                                    <a href="{{route("greenhouses.index")}}" class="btn btn-white px-5">
                                        <i class="fa fa-chevron-left"></i> Back to Greenhouses
                                        List</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


