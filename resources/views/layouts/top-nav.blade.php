<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="" class="logo logo-normal">
            <img src="{{asset('assets/img/logo.svg')}}" alt="Logo">
        </a>
        <a href="" class="logo-small">
            <img src="{{asset('assets/img/logo-small.svg')}}" alt="Logo">
        </a>
        <a href="" class="dark-logo">
            <img src="{{asset('assets/img/logo-dark.svg')}}" alt="Logo">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i class="ti ti-menu-deep"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
    </a>

    <div class="header-user">
        <div class="nav user-menu">

            <!-- Search -->
            <div class="nav-item nav-search-inputs me-auto">
                <div class="top-nav-search">
                </div>
            </div>
            <!-- /Search -->

            <div class="d-flex align-items-center">
                <div class="pe-1">
                    <a href="#" class="btn btn-outline-light bg-white btn-icon me-1" id="btnFullscreen">
                        <i class="ti ti-maximize"></i>
                    </a>
                </div>
                <div class="dropdown ms-1">
                    <a href="javascript:void(0);" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
								<span class="avatar avatar-md rounded">
									<img src="{{asset('assets/img/profiles/avatar-29.png')}}" alt="Img" class="img-fluid">
								</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="d-block">
                            <div class="d-flex align-items-center p-2">
										<span class="avatar avatar-md me-2 online avatar-rounded">
											<img src="{{asset('assets/img/profiles/avatar-29.png')}}" alt="img">
										</span>
                                <div>
                                    <h6 class="">{{auth()->user()->username}}</h6>
                                    <p class="text-primary mb-0">{{auth()->user()->role->name??null}}</p>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item d-inline-flex align-items-center p-2" href="{{route('user.profile')}}"> <i class="ti ti-user-circle me-2"></i>My Profile</a>
                            <hr class="m-0">
                            <a class="dropdown-item d-inline-flex align-items-center p-2" href="{{route('logout')}}"><i class="ti ti-login me-2"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="{{route('user.profile')}}">My Profile</a>
            <a class="dropdown-item" href="">Settings</a>
            <a class="dropdown-item" href="{{route('logout')}}">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
