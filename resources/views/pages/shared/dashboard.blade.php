@extends('layouts.master')
@section('page_title')
    Home
@endsection
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Dashboard</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert-message">
                    <div class="alert alert-success rounded-pill d-flex align-items-center justify-content-between border-success mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <span class="me-1 avatar avatar-sm flex-shrink-0"><img src="{{asset("assets/img/profiles/avatar-27.jpg")}}" alt="Img" class="img-fluid rounded-circle"></span>
                            <p><strong class="mx-1">“Success! ”</strong>{{session('success')}}</p>
                        </div>
                        <button type="button" class="btn-close p-0" data-bs-dismiss="alert" aria-label="Close"><span><i class="ti ti-x"></i></span></button>
                    </div>
                </div>
            @endif

            <!-- Dashboard Content -->
            <div class="card bg-dark">
                <div class="overlay-img">
                    <img src="{{asset("assets/img/bg/shape-04.png")}}" alt="img" class="img-fluid shape-01">
                    <img src="{{asset("assets/img/bg/shape-01.png")}}" alt="img" class="img-fluid shape-02">
                    <img src="{{asset("assets/img/bg/shape-02.png")}}" alt="img" class="img-fluid shape-03">
                    <img src="{{asset("assets/img/bg/shape-03.png")}}" alt="img" class="img-fluid shape-04">
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-xl-center justify-content-xl-between flex-xl-row flex-column">
                        <div class="mb-3 mb-xl-0">
                            <div class="d-flex align-items-center flex-wrap mb-2">
                                <h1 class="text-white me-2">Welcome, {{auth()->user()->username}}</h1>
                                <a href="#" class="avatar avatar-sm img-rounded bg-gray-800 dark-hover"><i class="ti ti-edit text-white"></i></a>
                            </div>
                            <p class="text-white">Have a Good day</p>
                        </div>
{{--                        <p class="text-white"><i class="ti ti-refresh me-1"></i>Updated Recently on {{now()->format('d M Y')}}</p>--}}
                    </div>
                </div>
            </div>
            <!-- /Dashboard Content -->

        </div>
    </div>

    <div class="row">

        <!-- Total Schools -->
        <div class="col-xxl-3 col-sm-6 d-flex">
            <div class="card flex-fill animate-card border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl bg-danger-transparent me-2 p-1">
                            <img src="{{asset('assets/img/icons/student.svg')}}" alt="img">
                        </div>
                        <div class="overflow-hidden flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="counter">{{count(\App\Models\Admin\School::all())}}</h2>
{{--                                <span class="badge bg-danger">1.2%</span>--}}
                            </div>
                            <p>Total Schools</p>
                        </div>
                    </div>
{{--                    <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">--}}
{{--                        <p class="mb-0">Active : <span class="text-dark fw-semibold">3643</span></p>--}}
{{--                        <span class="text-light">|</span>--}}
{{--                        <p>Inactive : <span class="text-dark fw-semibold">11</span></p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <!-- /Total Schools -->

        <!-- Total Examination -->
        <div class="col-xxl-3 col-sm-6 d-flex">
            <div class="card flex-fill animate-card border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-2 bg-secondary-transparent p-1">
                            <img src="{{asset('assets/img/icons/teacher.svg')}}" alt="img">
                        </div>
                        <div class="overflow-hidden flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="counter">{{count(\App\Models\Admin\Exam::all())}}</h2>
{{--                                <span class="badge bg-skyblue">1.2%</span>--}}
                            </div>
                            <p>Total Examination</p>
                        </div>
                    </div>
{{--                    <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">--}}
{{--                        <p class="mb-0">Active : <span class="text-dark fw-semibold">254</span></p>--}}
{{--                        <span class="text-light">|</span>--}}
{{--                        <p>Inactive : <span class="text-dark fw-semibold">30</span></p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <!-- /Total Examination -->

        <!-- Total Users -->
        <div class="col-xxl-3 col-sm-6 d-flex">
            <div class="card flex-fill animate-card border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-2 bg-warning-transparent p-1">
                            <img src="{{asset('assets/img/icons/staff.svg')}}" alt="img">
                        </div>
                        <div class="overflow-hidden flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="counter">{{count(\App\Models\User::query()->where('status','active')->get())}}</h2>
{{--                                <span class="badge bg-warning">1.2%</span>--}}
                            </div>
                            <p>Total Users</p>
                        </div>
                    </div>
{{--                    <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">--}}
{{--                        <p class="mb-0">Active : <span class="text-dark fw-semibold">161</span></p>--}}
{{--                        <span class="text-light">|</span>--}}
{{--                        <p>Inactive : <span class="text-dark fw-semibold">02</span></p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <!-- /Total Users -->

        <!-- Total Pending User -->
        <div class="col-xxl-3 col-sm-6 d-flex">
            <div class="card flex-fill animate-card border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl me-2 bg-success-transparent p-1">
                            <img src="{{asset('assets/img/icons/subject.svg')}}" alt="img">
                        </div>
                        <div class="overflow-hidden flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <h2 class="counter">{{count(\App\Models\User::query()->where('status','pending')->get())}}</h2>
{{--                                <span class="badge bg-success">1.2%</span>--}}
                            </div>
                            <p>Total User Request</p>
                        </div>
                    </div>
{{--                    <div class="d-flex align-items-center justify-content-between border-top mt-3 pt-3">--}}
{{--                        <p class="mb-0">Active : <span class="text-dark fw-semibold">81</span></p>--}}
{{--                        <span class="text-light">|</span>--}}
{{--                        <p>Inactive : <span class="text-dark fw-semibold">01</span></p>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <!-- /Total Pending User -->

    </div>

    @if(Auth::user()->role->name == 'admin')
        <div class="row">
            <div class="col-md-4">
                <div class="card flex-fill">
                    <div class="card-header  d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Recent Added schools</h4>
                        <a href="{{route('schools.list')}}" class="fw-medium">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($dashboardData['recentSchools'] as $rs)
                                <li class="list-group-item p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-lg flex-shrink-0 me-2">
                                                <img src="{{asset('assets/img/events/event-01.jpg')}}" class="img-fluid" alt="img">
                                            </a>
                                            <div class="overflow-hidden">
                                                <h6 class="mb-1"><a href="">{{$rs['name']}}</a>
                                                </h6>
                                                <p><i class="ti ti-calendar me-1"></i>{{\Carbon\Carbon::parse($rs['created_at'])->diffForHumans()}}</p>
                                            </div>
                                        </div>
{{--                                        <span class="badge badge-soft-danger d-inline-flex align-items-center"><i class="ti ti-circle-filled fs-5 me-1"></i>Full Day</span>--}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
                        <h4 class="card-title">Examination Summary</h4>
                    </div>
                    <div class="card-body px-0">
                        <div class="custom-datatable-filter table-responsive">
                            <table class="table ">
                                <thead class="thead-light">
                                <tr>
                                    <th>Exam #</th>
                                    <th>Name</th>
                                    <th>Subjects</th>
                                    <th>Registered Schools</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($dashboardData['examinationSummary'] as $es)
                                        <tr>
                                            <td>{{$es->id}}</td>
                                            <td>{{$es->name}}</td>
                                            <td>{{$es->subjects->count()}}</td>
                                            <td>{{$es->schoolRegistration->count()}}</td>
                                            <td>
                                                <a href="" class="badge bg-soft-primary">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
