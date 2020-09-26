@extends('layouts.main-app')

@section('pageTitle',$greenhouse->name." Greenhouse Node")
@section('pageTitleBody', $greenhouse->name." Greenhouse Node")

@section("page-button-area")
    <div class="float-sm-right">
        <div class="btn-group m-1" role="group">
            <button type="button" class="btn btn-light waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Exhaust Fan
            </button>
            <greenhouse-override-container
                greenhouse-override-url="{{route("greenhouse-node.override-actuator",["greenhouse"=>$greenhouse->code])}}"
                actuator="exhaust_fan"></greenhouse-override-container>
        </div>

        <div class="btn-group m-1" role="group">
            <button type="button" class="btn btn-light waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Heater
            </button>
            <greenhouse-override-container
                greenhouse-override-url="{{route("greenhouse-node.override-actuator",["greenhouse"=>$greenhouse->code])}}"
                actuator="heater"></greenhouse-override-container>
        </div>
        <div class="btn-group m-1">
            <a href="{{route("greenhouse-node.manage-conditions",["greenhouse"=>$greenhouse->code])}}"
               class="btn btn-light waves-effect waves-light">Manage Conditions</a>
            <button type="button"
                    class="btn btn-light split-btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                    data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
            </button>
            <greenhouse-clear-conditions
                greenhouse-clear-conditions-url="{{route("greenhouse-node.clear-conditions",["greenhouse"=>$greenhouse->code])}}">
            </greenhouse-clear-conditions>
        </div>

    </div>
@endsection

@section('page-content')
    <greenhouse-dashboard past-metric-url="{{route("greenhouse.get-past-metrics")}}"
                          greenhouse-code="{{$greenhouse->code}}"></greenhouse-dashboard>
@endsection

