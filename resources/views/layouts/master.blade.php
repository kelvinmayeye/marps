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
    @include('components.ui.theme-settings-slider')
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap Bundle -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Moment JS -->
<script src="{{ asset('assets/js/moment.js') }}"></script>

<!-- Daterangepicker -->
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<!-- Feather Icons -->
<script src="{{ asset('assets/js/feather.min.js') }}"></script>

<!-- SweetAlert2 (must be loaded BEFORE any call to Swal) -->
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>

<!-- Slimscroll -->
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- ApexCharts -->
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Counter Up -->
<script src="{{ asset('assets/plugins/countup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/plugins/countup/jquery.waypoints.min.js') }}"></script>

<!-- Yield Page Specific Scripts -->
@yield('scripts')

<!-- Custom Script -->
<script src="{{ asset('assets/js/script.js') }}"></script>


<script>
    $(document).ready(function() {

    });

    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: message,
            confirmButtonText: 'OK'
        });
    }

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            confirmButtonText: 'OK'
        });
    }

    function confirmAction(url, data, confirmMessage) {
        Swal.fire({
            title: 'Please Confirm',
            text: confirmMessage,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {
                data._token = `{{ csrf_token() }}`;

                $.post(url, data)
                    .done(function (response) {
                        if (response.status === 'success') {
                            showSuccess(response.msg || 'Action completed successfully.');
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        } else {
                            showError(response.msg || 'Action failed.');
                        }
                    })
                    .fail(function (xhr) {
                        showError(xhr.responseJSON?.message || 'An error occurred.');
                    });
            }
        });
    }
</script>
@yield('extra-script')
</body>
</html>
