<div class="sidebar-contact ">
    <div class="toggle-theme"  data-bs-toggle="offcanvas" data-bs-target="#theme-setting"><i class="fa fa-cog fa-w-16 fa-spin"></i></div>
</div>
<div class="sidebar-themesettings offcanvas offcanvas-end" id="theme-setting">
    <div class="offcanvas-header d-flex align-items-center justify-content-between bg-light-500">
        <div>
            <h4 class="mb-1">Theme Customizer</h4>
            <p>Choose your themes & layouts etc.</p>
        </div>
        <a href="#" class="custom-btn-close d-flex align-items-center justify-content-center text-white"  data-bs-dismiss="offcanvas"><i class="ti ti-x"></i></a>
    </div>
    <div class="themesettings-inner offcanvas-body">
        <div class="accordion accordion-customicon1 accordions-items-seperate" id="settingtheme">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#layoutsetting" aria-expanded="true" aria-controls="collapsecustomicon1One">
                        Select Layouts
                    </button>
                </h2>
                <div id="layoutsetting" class="accordion-collapse collapse show"  >
                    <div class="accordion-body">
                        <div class="row gx-3">
                            <div class="col-4">
                                <div class="theme-layout mb-3">
                                    <input type="radio" name="LayoutTheme" id="defaultLayout" value="default" checked>
                                    <label for="defaultLayout">
                                            <span class="d-block mb-2 layout-img">
                                                <i class="fa fa-image fa-2x"></i>
                                            </span>
                                        <span class="layout-type">Default</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="theme-layout mb-3">
                                    <input type="radio" name="LayoutTheme" id="miniLayout" value="mini" >
                                    <label for="miniLayout">
                                            <span class="d-block mb-2 layout-img">
                                                <i class="fa fa-compress fa-2x"></i>
                                            </span>
                                        <span class="layout-type">Mini</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="theme-layout mb-3">
                                    <input type="radio" name="LayoutTheme" id="boxLayout" value="box" >
                                    <label for="boxLayout">
                                            <span class="d-block mb-2 layout-img">
                                                <i class="fa fa-box fa-2x"></i>
                                            </span>
                                        <span class="layout-type">Boxed</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="layout-rtl.html" class="theme-layout mb-3">
                                        <span class="d-block mb-2 layout-img">
                                            <i class="fa fa-align-right fa-2x"></i>
                                        </span>
                                    <span class="layout-type">RTL</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#colorsetting" aria-expanded="true">
                        Top Bar Color
                    </button>
                </h2>
                <div id="colorsetting" class="accordion-collapse collapse show"	>
                    <div class="accordion-body">
                        <div class="d-flex align-items-center">
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="topbar" id="whiteTopbar" value="white" checked>
                                <label for="whiteTopbar" class="white-topbar"></label>
                            </div>
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="topbar" id="darkTopbar" value="dark">
                                <label for="darkTopbar" class="dark-topbar"></label>
                            </div>
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="topbar" id="primaryTopbar" value="primary">
                                <label for="primaryTopbar" class="primary-topbar"></label>
                            </div>
                            <div class="theme-colorselect m-1">
                                <input type="radio" name="topbar" id="greyTopbar" value="grey">
                                <label for="greyTopbar" class="grey-topbar"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#modesetting" aria-expanded="true">
                        Color Mode
                    </button>
                </h2>
                <div id="modesetting" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="row gx-3">
                            <div class="col-6">
                                <div class="theme-mode">
                                    <input type="radio" name="theme" id="lightTheme" value="light" checked>
                                    <label for="lightTheme" class="p-2 rounded fw-medium w-100">
                                        <span class="avatar avatar-md d-inline-flex rounded me-2"><i class="ti ti-sun-filled"></i></span>Light Mode
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="theme-mode">
                                    <input type="radio" name="theme" id="darkTheme" value="dark" >
                                    <label for="darkTheme" class="p-2 rounded fw-medium w-100">
                                        <span class="avatar avatar-md d-inline-flex rounded me-2"><i class="ti ti-moon-filled"></i></span>Dark Mode
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarsetting" aria-expanded="true">
                        Sidebar Color
                    </button>
                </h2>
                <div id="sidebarsetting" class="accordion-collapse collapse show"	 >
                    <div class="accordion-body">
                        <div class="d-flex align-items-center">
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="sidebar" id="lightSidebar" value="light" checked>
                                <label for="lightSidebar" class="d-block rounded mb-2">
                                </label>
                            </div>
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="sidebar" id="darkSidebar" value="dark">
                                <label for="darkSidebar" class="d-block rounded bg-dark mb-2">
                                </label>
                            </div>
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="sidebar" id="primarySidebar" value="primary">
                                <label for="primarySidebar" class="d-block rounded bg-primary mb-2">
                                </label>
                            </div>
                            <div class="theme-colorselect m-1 me-3">
                                <input type="radio" name="sidebar" id="darkblackSidebar" value="darkblack">
                                <label for="darkblackSidebar" class="d-block rounded bg-darkblack mb-2">
                                </label>
                            </div>
                            <div class="theme-colorselect m-1">
                                <input type="radio" name="sidebar" id="darkblueSidebar" value="darkblue">
                                <label for="darkblueSidebar" class="d-block rounded bg-darkblue mb-2">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarbgsetting" aria-expanded="true">
                        Sidebar Background
                    </button>
                </h2>
                <div id="sidebarbgsetting" class="accordion-collapse collapse show"	 >
                    <div class="accordion-body">
                        <div class="d-flex align-items-center">
                            <div class="theme-sidebarbg me-3">
                                <input type="radio" name="sidebarbg" id="sidebarBg1" value="sidebarbg1" checked>
                                <label for="sidebarBg1" class="d-block rounded">
                                    <img src="{{asset('assets/img/theme/bg-01.jpg')}}" alt="img" class="rounded">
                                </label>
                            </div>
                            <div class="theme-sidebarbg me-3">
                                <input type="radio" name="sidebarbg" id="sidebarBg2" value="sidebarbg2">
                                <label for="sidebarBg2" class="d-block rounded">
                                    <img src="{{asset('assets/img/theme/bg-02.jpg')}}" alt="img" class="rounded">
                                </label>
                            </div>
                            <div class="theme-sidebarbg me-3">
                                <input type="radio" name="sidebarbg" id="sidebarBg3" value="sidebarbg3">
                                <label for="sidebarBg3" class="d-block rounded">
                                    <img src="{{asset('assets/img/theme/bg-03.jpg')}}" alt="img" class="rounded">
                                </label>
                            </div>
                            <div class="theme-sidebarbg me-3">
                                <input type="radio" name="sidebarbg" id="sidebarBg4" value="sidebarbg4">
                                <label for="sidebarBg4" class="d-block rounded">
                                    <img src="{{asset('assets/img/theme/bg-04.jpg')}}" alt="img" class="rounded">
                                </label>
                            </div>
                            <div class="theme-sidebarbg me-3">
                                <input type="radio" name="sidebarbg" id="sidebarBg5" value="sidebarbg5">
                                <label for="sidebarBg5" class="d-block rounded">
                                    <img src="{{asset('assets/img/theme/bg-05.jpg')}}" alt="img" class="rounded">
                                </label>
                            </div>
                            <div class="theme-sidebarbg me-3">
                                <input type="radio" name="sidebarbg" id="sidebarBg6" value="sidebarbg6">
                                <label for="sidebarBg6" class="d-block rounded">
                                    <img src="{{asset('assets/img/theme/bg-06.jpg')}}" alt="img" class="rounded">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button text-dark fs-16" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarcolor" aria-expanded="true">
                        Theme Colors
                    </button>
                </h2>
                <div id="sidebarcolor" class="accordion-collapse collapse show"	 >
                    <div class="accordion-body pb-2">
                        <div class="d-flex align-items-center">
                            <div class="theme-colorsset me-3 mb-2">
                                <input type="radio" name="color" id="primaryColor" value="primary" checked>
                                <label for="primaryColor" class="primary-clr"></label>
                            </div>
                            <div class="theme-colorsset me-3 mb-2">
                                <input type="radio" name="color" id="violetColor" value="violet" >
                                <label for="violetColor" class="violet-clr"></label>
                            </div>
                            <div class="theme-colorsset me-3 mb-2">
                                <input type="radio" name="color" id="pinkColor" value="pink" >
                                <label for="pinkColor" class="pink-clr"></label>
                            </div>
                            <div class="theme-colorsset me-3 mb-2">
                                <input type="radio" name="color" id="orangeColor" value="orange">
                                <label for="orangeColor" class="orange-clr"></label>
                            </div>
                            <div class="theme-colorsset me-3 mb-2">
                                <input type="radio" name="color" id="greenColor" value="green">
                                <label for="greenColor" class="green-clr"></label>
                            </div>
                            <div class="theme-colorsset me-3 mb-2">
                                <input type="radio" name="color" id="redColor" value="red">
                                <label for="redColor" class="red-clr"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-light-500 p-3">
        <div class="row gx-3">
            <div class="col-6">
                <a href="#" id="resetbutton" class="btn btn-light close-theme w-100">Reset</a>
            </div>
            <div class="col-6">
                <a href="https://1.envato.market/52Ndo"  target="_blank" class="btn btn-primary w-100" >Buy Now</a>
            </div>
        </div>
    </div>
</div>
