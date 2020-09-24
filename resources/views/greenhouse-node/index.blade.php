@extends('layouts.main-app')

@section('pageTitle',$greenhouse->name." Greenhouse Node")
@section('pageTitleBody', $greenhouse->name." Greenhouse Node")

@section("page-button-area")
    <div class="float-sm-right">
        <a href="{{route("greenhouse-node.manage-conditions",["greenhouse"=>$greenhouse->code])}}"
           class="btn btn-light">Manage Conditions</a>
    </div>
@endsection

@section('page-content')
    <greenhouse-dashboard greenhouse-code="{{$greenhouse->code}}"></greenhouse-dashboard>
@endsection

