<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("pageTitle") | {{ config('app.name', 'Greenhouse IoT') }}</title>

    <!--favicon-->
    <link rel="icon" href="{{asset("assets/images/favicon.ico?1")}}" type="image/x-icon">

@stack("pageStyle")

<!-- simplebar CSS-->
    <link href="{{asset("assets/plugins/simplebar/css/simplebar.css")}}" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="{{asset("assets/css/animate.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{asset("assets/css/icons.css")}}" rel="stylesheet" type="text/css"/>

    <link href="{{asset("fontawesome/css/all.css")}}" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="{{asset("assets/css/sidebar-menu.css")}}" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="{{asset("assets/css/app-style.css")}}" rel="stylesheet"/>

</head>

<body class="bg-theme bg-theme3">

<!-- start loader -->
<div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
        <div class="loader-wrapper-inner">
            <div class="loader"></div>
        </div>
    </div>
</div>
<!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">

@yield("content")

<!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

</div><!--wrapper-->

<!-- Bootstrap core JavaScript-->
<script src="{{asset("assets/js/jquery.min.js")}}"></script>
<script src="{{asset("assets/js/popper.min.js")}}"></script>
<script src="{{asset("assets/js/bootstrap.min.js")}}"></script>

<!-- simplebar js -->
<script src="{{asset("assets/plugins/simplebar/js/simplebar.js")}}"></script>

<!-- sidebar-menu js -->
<script src="{{asset("assets/js/sidebar-menu.js")}}"></script>

<!-- easypiechart js -->
<script src="{{asset("assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js")}}"></script>

<script>
    $('.easy-dash-chart').easyPieChart({
        easing: 'easeOutBounce',
        barColor: '#ffffff',
        lineWidth: 10,
        trackColor: 'rgba(255, 255, 255, 0.12)',
        scaleColor: false,
        onStep: function (from, to, percent) {
            $(this.el).find('.w_percent').text(Math.round(percent));
        }
    });
</script>

<!-- Custom scripts -->
<script src="{{asset("assets/js/app-script.js")}}"></script>

<script src="{{asset("assets/plugins/alerts-boxes/js/sweetalert.min.js")}}"></script>

<script src="{{asset("js/app.js")}}"></script>

@stack("pageJavascript")

</body>
</html>

