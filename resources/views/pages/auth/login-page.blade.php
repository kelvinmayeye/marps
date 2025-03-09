<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Municipal academic results processing system">
    <meta name="keywords" content="municipal, results, academic, processing, students, tanzania, Regional">
    <meta name="author" content="Municipal academic result processing systems">
    <meta name="robots" content="noindex, nofollow">
    <title>Municipal academic result processing systems</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("assets/img/favicon.png")}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/icons/feather/feather.css")}}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/tabler-icons/tabler-icons.css")}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/fontawesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome/css/all.min.css")}}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">

</head>

<body class="account-page">

<!-- Main Wrapper -->
<div class="main-wrapper">

    <div class="container-fuild">
        <div class="login-wrapper w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
            <div class="row">
                <div class="col-lg-6">
                    <div class="d-lg-flex align-items-center justify-content-center bg-light-300 d-lg-block d-none flex-wrap vh-100 overflowy-auto bg-01">
                        <div>
                            <img src="{{asset("assets/img/authentication/coat_of_arms.png")}}" alt="Img">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                        <div class="col-md-8 mx-auto p-4">
                            <form action="{{route('home')}}">
                                <div>
                                    <div class=" mx-auto text-center">
                                        <img src="{{asset("assets/img/authentication/municipal-logo.png")}}" class="img-fluid" alt="Logo">
                                    </div>
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="">
                                                <h2 class="">Welcome</h2>
                                                <p class="mb-0">Please enter your details to sign in</p>
                                            </div>
                                            <div class="mb-3 ">
                                                <label class="form-label">Email Address</label>
                                                <div class="input-icon mb-3 position-relative">
														<span class="input-icon-addon">
															<i class="ti ti-mail"></i>
														</span>
                                                    <input type="text" value="" class="border border-1 border-primary form-control">
                                                </div>
                                                <label class="form-label">Password</label>
                                                <div class="pass-group">
                                                    <input type="password" class="pass-input border border-1 border-primary form-control">
                                                    <span class="ti toggle-password ti-eye-off"></span>
                                                </div>
                                            </div>

                                            <div class="form-wrap form-wrap-checkbox mb-3">
                                                <div class="text-end ">
                                                    <a href="" class="link-danger">Forgot
                                                        Password?</a>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-success w-100">Login</button>
                                            </div>
                                            <div class="text-center">
                                                <h6 class="fw-normal text-dark mb-0">Don’t have an account? <a href="" class="hover-a "> Create Account</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <p class="mb-0 ">Copyright &copy; {{now()->format('Y')}} - Marps</p>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>

</div>
<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/js/jquery-3.7.1.min.js')}}" data-cfasync="false"></script>

<!-- Bootstrap Core JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" type="3e32bc424f3abc9d222f2e59-text/javascript"></script>

<!-- Feather Icon JS -->
<script src="{{asset('assets/js/feather.min.js')}}" type="3e32bc424f3abc9d222f2e59-text/javascript"></script>

<!-- Slimscroll JS -->
<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}" type="3e32bc424f3abc9d222f2e59-text/javascript"></script>

<!-- Select2 JS -->
<script src="{{asset("assets/plugins/select2/js/select2.min.js")}}" type="1ab521687d42ab409e1252d8-text/javascript"></script>

<!-- Custom JS -->
<script src="{{asset("assets/js/script.js")}}" type="1ab521687d42ab409e1252d8-text/javascript"></script>

<script src="{{asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="3e32bc424f3abc9d222f2e59-|49" defer=""></script></body>

</html>
