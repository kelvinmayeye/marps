<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{route('user.home')}}" class="d-flex align-items-center border bg-white rounded p-2 mb-4">
                        <img src="{{asset("assets/img/icons/global-img.svg")}}" class="avatar avatar-md img-fluid rounded" alt="Profile">
                        <span class="text-dark ms-2 fw-normal">User School name</span><!-- else MARPS -->
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr"><span>Main</span></h6>
                    <ul>
                        <li class="active"><a href="{{route('user.home')}}"><i class="ti ti-layout-dashboard"></i><span>Dashboard </span></a></li>
                        <li class=""><a href="{{route('schools.list')}}"><i class="ti ti-school"></i><span>Schools </span></a></li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr"><span>Academic</span></h6>
                    <ul>
                        <li><a href="{{route('subject.list')}}"><i class="ti ti-book"></i><span>Subject</span></a></li>
                        <li><a href="{{route('class.list')}}"><i class="ti ti-school-bell"></i><span>Classes</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-hexagonal-prism-plus"></i><span>Examinations</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{route('exam.list')}}">Exam</a></li>
                                <li><a href="">Grades</a></li>
                                <li><a href="">Academic Year</a></li>
                                {{--                                <li><a href="">Exam Attendance</a></li>--}}
                                {{--                                <li><a href="">Exam Results</a></li>--}}
                            </ul>
                        </li>
                    </ul>
                </li>
                {{--                <li>--}}
                {{--                    <h6 class="submenu-hdr"><span>Announcements</span></h6>--}}
                {{--                    <ul>--}}
                {{--                        <li><a href="notice-board.html"><i class="ti ti-clipboard-data"></i><span>Notice Board</span></a></li>--}}
                {{--                        <li><a href="events.html"><i class="ti ti-calendar-question"></i><span>Events</span></a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                {{--                <li>--}}
                {{--                    <h6 class="submenu-hdr"><span>Reports</span></h6>--}}
                {{--                    <ul>--}}
                {{--                        <li><a href=""><i class="ti ti-calendar-due"></i><span>Attendance--}}
                {{--											Report</span></a></li>--}}
                {{--                        <li><a href=""><i class="ti ti-graph"></i><span>Class Report</span></a>--}}
                {{--                        </li>--}}
                {{--                        <li><a href=""><i class="ti ti-chart-infographic"></i><span>Student--}}
                {{--											Report</span></a></li>--}}
                {{--                        <li><a href=""><i class="ti ti-calendar-x"></i><span>Grade--}}
                {{--											Report</span></a></li>--}}
                {{--                        <li><a href=""><i class="ti ti-line"></i><span>Leave Report</span></a>--}}
                {{--                        </li>--}}
                {{--                        <li><a href=""><i class="ti ti-mask"></i><span>Fees Report</span></a>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                <li>
                    <h6 class="submenu-hdr"><span>User Management</span></h6>
                    <ul>
                        <li><a href="{{route('users.list')}}"><i class="ti ti-users-minus"></i><span>Users</span></a></li>
                        <li>
                            <a href="{{route('roles.list')}}">
                                <i class="ti ti-shield-plus"></i><span>Roles & Permissions</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="ti ti-user-question"></i>
                                <span>Delete Account Request</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">
                        <span> settings</span>
                    </h6>
                    <ul>
                        <li>
                            <a href="">
                                <i class="ti ti-settings"></i>
                                <span>General Setting</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
