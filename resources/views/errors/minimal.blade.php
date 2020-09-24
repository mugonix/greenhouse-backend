@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center error-pages">
                    <h1 class="error-title text-white"> @yield("code")</h1>
                    <h2 class="error-sub-title text-white">@yield("title")</h2>

                    <p class="error-message text-white text-uppercase">@yield("message")</p>

                    <div class="mt-4">
                        <a href="{{route('home')}}" class="btn btn-light btn-round m-1">Go To Home </a>
                        <a href="{{\URL::previous()}}" class="btn btn-light btn-round m-1">Previous Page </a>
                    </div>

                    <div class="mt-4">
                        <p class="text-white">Copyright © {{date("Y")}} Greenhouse IoT. A MugonixWorld Company. | All
                            rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
