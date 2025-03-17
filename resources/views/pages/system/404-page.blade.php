<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow">
    <title>{{env('APP_NAME')}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/icons/feather/feather.css')}}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/tabler-icons/tabler-icons.css')}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>

<body class="error-page">

<!-- Main Wrapper -->
<div class="main-wrapper ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-md-6">
                <div class="d-flex flex-column justify-content-between vh-100">
                    <div class="text-center p-4">
{{--                        <img src="{{asset('assets/img/logo.svg')}}" alt="img" class="img-fluid">--}}
                    </div>
                    <div class="d-flex flex-column justify-content-center align-items-center mb-4">
                        <div class="mb-4">
                            <img src="{{asset('assets/img/authentication/error-404.svg')}}" class="error-img img-fluid" alt="Img">
                        </div>
                        <h3 class="h2 mb-3">Oops, something went wrong</h3>
                        <p class="text-center">Error 404 Page not found. Sorry the page you looking for doesn’t
                            exist or has been moved</p>
                        <a href="{{route('home')}}" class="btn btn-primary d-flex align-items-center"><i class="ti ti-arrow-left me-2"></i>Back to Dashboard</a>
                    </div>
                    <div class="text-center p-4">
                        <p>Copyright &copy; {{now()->format('Y')}} - Marps</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}" type="a7cf5f2b10448c76c9d1f558-text/javascript"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="a7cf5f2b10448c76c9d1f558-text/javascript"></script>

<!-- Feather Icon JS -->
<script src="{{asset('assets/js/feather.min.js')}}" type="a7cf5f2b10448c76c9d1f558-text/javascript"></script>

<!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}" type="a7cf5f2b10448c76c9d1f558-text/javascript"></script>

<!-- Select2 JS -->
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}" type="a7cf5f2b10448c76c9d1f558-text/javascript"></script>

<!-- Custom JS -->
<script src="{{asset('assets/js/script.js')}}" type="a7cf5f2b10448c76c9d1f558-text/javascript"></script>

<script src="{{asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="a7cf5f2b10448c76c9d1f558-|49" defer=""></script></body>

</html>
