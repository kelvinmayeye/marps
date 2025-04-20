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
                            <form action="{{route('register')}}" method="post">
                                @csrf
                                <div>
{{--                                                                        <div class=" mx-auto text-center">--}}
{{--                                                                            <img src="{{asset("assets/img/authentication/municipal-logo.png")}}" class="img-fluid" alt="Logo">--}}
{{--                                                                        </div>--}}
                                    <div class="card">
                                        <div class="card-body p-4">
                                            <div class="row">
                                                <h2 class="">Register</h2>
                                                <p class="mb-0">Please enter your details to register account</p>
                                                @if(session()->has('error'))
                                                    <small class="text-danger">{{session('error')}}</small>
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 ">
                                                        <label class="form-label">FullName</label>
                                                        <input type="text" value="" name="name" class="border border-1 border-primary form-control" placeholder="eg.John Doe Michael"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title</label>
                                                        <select class="form-control border border-1 border-primary user-title" name="title">
                                                            <option value="" selected>--Select title--</option>
                                                            <option value="Mr">Mr</option>
                                                            <option value="Miss">Miss</option>
                                                            <option value="Sir">Sir</option>
                                                            <option value="Madam">Madam</option>
                                                            <option value="Dr">Dr</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Username</label>
                                                        <input type="text" name="username" class="border border-1 border-primary form-control" placeholder="username" onblur="checkIfUsernameExist(this)" required>
                                                        <div class="invalid-feedback username-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3 ">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" value="" name="email" class="border border-1 border-primary form-control" placeholder="email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <div class="pass-group">
                                                            <input type="password" name="password" class="pass-input border border-1 border-primary form-control" oninput="validatePassword()" required>
                                                            <div class="invalid-feedback password-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirm Password</label>
                                                        <div class="pass-group">
                                                            <input type="password" name="confirm_password" class="pass-input border border-1 border-primary form-control" oninput="validatePassword()" required>
                                                            <div class="invalid-feedback confirm-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone number <small class="text-danger">*</small></label>
                                                        <input type="text" name="phone_number" class="form-control border border-1 border-primary user-phone-number" placeholder="eg.0785100190" pattern="^0\d{9}$"
                                                               maxlength="10"
                                                               title="Number must start 0 and max in length is 10" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">School <small class="text-danger">*</small></label>
                                                        <select class="form-control border border-1 border-primary user-school-id" name="school_id" required>
                                                            <option value="" selected>--Select School--</option>
                                                            @foreach($schools??[] as $s)
                                                                <option value="{{$s->id}}">{{$s->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Position</label>
                                                        <select class="form-control border border-1 border-primary user-school-position" name="school_position">
                                                            <option value="" selected>--Select school position--</option>
                                                            <option value="Head Teacher">Head Teacher</option>
                                                            <option value="Academics">Academics</option>
                                                            <option value="Despline Master">Despline Master</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-success w-100">Register</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <h6 class="fw-normal text-dark mb-0">I have an account <a href="{{url('/')}}" class="hover-a "> Login Here</a>
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

<script src="{{asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="3e32bc424f3abc9d222f2e59-|49" defer=""></script>
<script>
    function validatePassword() {
        let passwordField = $('input[name="password"]');
        let password = passwordField.val();

        let confirmField = $('input[name="confirm_password"]');
        let confirmPassword = confirmField.val();

        let strengthFeedback = $('.password-feedback');
        let confirmFeedback = $('.confirm-feedback');

        // Password strength logic
        let strength = 'Low';
        let strengthClass = 'text-danger';

        if (password.length >= 6) {
            if (/[a-zA-Z]/.test(password) && /\d/.test(password)) {
                if (password.length >= 8) {
                    strength = 'Strong';
                    strengthClass = 'text-success';
                } else {
                    strength = 'Moderate';
                    strengthClass = 'text-warning';
                }
            }
        }

        // Display strength feedback
        if (password.length > 0) {
            passwordField.removeClass('is-invalid');
            strengthFeedback.removeClass('text-danger text-warning text-success').addClass(strengthClass).text(`Password strength: ${strength}`).show();
        } else {
            passwordField.addClass('is-invalid');
            strengthFeedback.removeClass('text-warning text-success').addClass('text-danger').text('Password is required').show();
        }

        // Password match check
        if (confirmPassword.length > 0 && password !== confirmPassword) {
            confirmField.addClass('is-invalid');
            confirmFeedback.text('Passwords do not match').show();
        } else if (confirmPassword.length > 0) {
            confirmField.removeClass('is-invalid');
            confirmFeedback.text('').hide();
        }
    }

    function checkIfUsernameExist(obj) {
        let usernameField = $(obj);
        let username = usernameField.val().trim();
        let feedback = $('.username-feedback');

        if (username === '') {
            usernameField.addClass('is-invalid');
            feedback.text('Username is required').show();
            usernameField.focus();
            return;
        }

        if (username.toLowerCase() === 'admin') {
            usernameField.addClass('is-invalid');
            feedback.text('Username "admin" is not allowed. Please choose another.').show();
            usernameField.focus();
            return;
        }

        $.get("{{ route('ajax.confirm.username') }}", { username: username }, function(response) {
            if (response.exists) {
                usernameField.addClass('is-invalid');
                feedback.text('Username already taken. Please choose another.').show();
                usernameField.focus();
            } else {
                usernameField.removeClass('is-invalid');
                feedback.text('').hide();
            }
        }).fail(function() {
            usernameField.addClass('is-invalid');
            feedback.text('Error checking username. Please try again.').show();
            usernameField.focus();
        });
    }


    $(function() {
        $('.password-feedback, .confirm-feedback').hide();
    });
</script>
</body>

</html>
