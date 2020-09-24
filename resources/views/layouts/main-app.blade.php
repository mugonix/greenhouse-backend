@extends('layouts.app')

@section('content')
    <!--Start sidebar-wrapper-->
    @include("layouts.partials.left-sidebar")
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link toggle-menu" href="javascript:void();">
                        <i class="icon-menu menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    {{--                    <form class="search-bar">--}}
                    {{--                        <input type="text" class="form-control" placeholder="Enter keywords">--}}
                    {{--                        <a href="javascript:void();"><i class="icon-magnifier"></i></a>--}}
                    {{--                    </form>--}}
                </li>
            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="{{asset("assets/images/default.png")}}" class="img-circle"
                                                        alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="javaScript:void();">
                                <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3"
                                                             src="{{asset("assets/images/default.png")}}"
                                                             alt="user avatar"></div>
                                    <div class="media-body">
                                        <h6 class="mt-2 user-title">{{auth()->user()->name}}</h6>
                                        <p class="user-subtitle">{{"@".auth()->user()->username}}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a href="{{route("logout")}}"><i class="icon-power mr-2"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!--End topbar header-->

    <div class="clearfix"></div>

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">@yield("pageTitleBody")</h4>
                </div>
                <div class="col-sm-3">
                    @yield("page-button-area")
                </div>
            </div>
            <!-- End Breadcrumb-->

            <div class="row" id="app">
                <div class="col-12">
                    @yield('page-content')
                </div>
            </div>
            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->

    </div><!--End content-wrapper-->

@endsection
