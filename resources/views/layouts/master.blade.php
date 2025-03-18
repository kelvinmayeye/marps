<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Municipal academic results processing system">
    <meta name="keywords" content="municipal, results, academic, processing, students, tanzania, Regional">
    <meta name="author" content="Municipal academic result processing systems">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('page_title') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("assets/img/favicon.png")}}">

    <!-- Theme Script js -->
    <script src="{{asset("assets/js/theme-script.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/icons/feather/feather.css")}}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/tabler-icons/tabler-icons.css")}}">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/fontawesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/all.min.css")}}">

    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap5.min.css')}}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap-datetimepicker.min.css")}}">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/owlcarousel/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/owlcarousel/owl.theme.default.min.css")}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">

    @yield('extra-css')

</head>

<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
@include('layouts.top-nav')
<!-- /Header -->

    <!-- Sidebar -->
@include('layouts.side-nav')
<!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            @yield('content')

        </div>
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}" data-cfasync="false"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset("assets/js/bootstrap.bundle.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Daterangepikcer JS -->
<script src="{{asset("assets/js/moment.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>
<script src="{{asset("assets/js/bootstrap-datetimepicker.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Feather Icon JS -->
<script src="{{asset("assets/js/feather.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Slimscroll JS -->
<script src="{{asset("assets/js/jquery.slimscroll.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Datatable JS -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}" type="text/javascript" data-cfasync="false"></script>
<script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}" type="text/javascript" data-cfasync="false"></script>

<!-- Chart JS -->
<script src="{{asset("assets/plugins/apexchart/apexcharts.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>
<script src="{{asset("assets/plugins/apexchart/chart-data.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Owl JS -->
<script src="{{asset("assets/plugins/owlcarousel/owl.carousel.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Select2 JS -->
<script src="{{asset("assets/plugins/select2/js/select2.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<!-- Counter JS -->
<script src="{{asset("assets/plugins/countup/jquery.counterup.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>
<script src="{{asset("assets/plugins/countup/jquery.waypoints.min.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

@yield('scripts')

<!-- Custom JS -->
<script src="{{asset("assets/js/script.js")}}" type="ef78bac5a6f4763a5095342c-text/javascript"></script>

<script src="{{asset("assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js")}}" data-cf-settings="ef78bac5a6f4763a5095342c-|49" defer=""></script>
</body>
@yield('extra-script')
</body>
</html>
