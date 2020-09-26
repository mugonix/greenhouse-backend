@extends('layouts.main-app')

@section('pageTitle',$greenhouse->name." Greenhouse Conditions")
@section('pageTitleBody', $greenhouse->name." Greenhouse Conditions")

@push('pageStyle')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}"/>
@endpush

@push("pageJavascript")
    <!--Bootstrap Touchspin Js-->
    <script src="{{asset("assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js")}}"></script>
    <script>
        $(".temperature_controls").TouchSpin({
            min: 18,
            max: 32,
            step: 1,
            decimals: 1,
            boostat: 5,
            maxboostedstep: 10,
            postfix: 'ºC'
        });
    </script>

@endpush

@section("page-button-area")
    <div class="float-sm-right">
        <a href="{{route("greenhouse-node.show",["greenhouse"=>$greenhouse->code])}}"
           class="btn btn-light">Greenhouse Node Home</a>
    </div>
@endsection

@section('page-content')
    <greenhouse-conditions greenhouse-code="{{$greenhouse->code}}" get-env-limits-url="{{route("greenhouse.get-environmental-limits")}}"
                           update-env-limits-url="{{route("greenhouse.update-environmental-limits")}}"></greenhouse-conditions>
@endsection

