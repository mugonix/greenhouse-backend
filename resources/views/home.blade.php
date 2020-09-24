@extends('layouts.main-app')

@section("pageTitle","Dashboard")
@section("pageTitleBody","Dashboard")

@section('page-content')
    <div class="row">
        @forelse($greenhouses as $greenhouse)
            <div class="col-md-5">
                <div class="card">
                    <img src="{{asset("assets/images/gh1.jpg")}}" height="200" class="card-img-top" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$greenhouse->name}}</h5>
                        <hr style="margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 0.5px solid rgba(197, 194, 194, 0.36);"/>
                        <?php
                        $isLastMetricPresent = count($greenhouse->greenhouse_metrics) > 0;
                        $lastMetric = $isLastMetricPresent ? $greenhouse->greenhouse_metrics[0] : null;
                        ?>
                        <div class="row text-center">
                            <div class="col-md-3">
                                @if($isLastMetricPresent)
                                    @if(Carbon\Carbon::now()->gt($lastMetric->created_at->addSeconds(20)))
                                        <span class="text-danger" style="font-size: xx-large;">
                                        <i class="fa fa-times"></i>
                                    </span>
                                    @else
                                        <span class="text-success" style="font-size: xx-large;">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    @endif
                                @else
                                    <span class="text-danger" style="font-size: xx-large;">
                                        <i class="fa fa-times"></i>
                                    </span>
                                @endif
                                <span style="font-size: 13px; text-transform: uppercase; display: block;">Status</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-size: xx-large;"><i class="fa fa-thermometer-2"></i></span>
                                <span style="font-size: 13px; text-transform: uppercase; display: block;">{{is_null($lastMetric)?"-":$lastMetric->temperature}}ºC</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-size: xx-large;"><i class="icon-drop icons"></i></span>
                                <span style="font-size: 13px; text-transform: uppercase; display: block;">{{is_null($lastMetric)?"-":$lastMetric->humidity}}%</span>
                            </div>
                            <div class="col-md-3">
                                <span style="font-size: xx-large;"><i class="fas fa-water"></i></span>
                                <span style="font-size: 13px; text-transform: uppercase; display: block;">{{is_null($lastMetric)?"-":$lastMetric->soil_moisture}}%</span>
                            </div>
                        </div>

                        {{--                        <hr style="margin-top: 1rem;margin-bottom: 1rem;border: 0;border-bottom: 1px solid rgba(197, 194, 194, 0.36);"/>--}}

                        {{--                        <div class="row">--}}
                        {{--                            <div class="col-md-12">--}}
                        {{--                                <div class="row">--}}
                        {{--                                    <div class="col-md-2 text-center">--}}
                        {{--                                        <i class="fa fa-exclamation-circle"--}}
                        {{--                                           style="font-size: 180%; line-height: 1.5;"></i>--}}
                        {{--                                    </div>--}}
                        {{--                                    <div class="col-md-8">--}}
                        {{--                                        <span--}}
                        {{--                                            style="font-size: 13px; text-transform: uppercase; display: block;">Alert</span>--}}
                        {{--                                        <span>Fence Breach</span>--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}

                        {{--                            </div>--}}
                        {{--                        </div>--}}

                        <hr style="margin-top: 1rem;margin-bottom: 1rem;border: 0;border-bottom: 1px solid rgba(197, 194, 194, 0.36);"/>
                        <div class="text-center">
                            <a href="{{route("greenhouse-node.show",["greenhouse"=>$greenhouse->code])}}"
                               class="btn btn-light">More Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-12 text-center pt-3" style="height: 600px;">
                <span class="my-auto">You do not have any greenhouses on your account.</span>
            </div>
        @endforelse
    </div>
@endsection
