@extends('layouts.master')
@section('page_title')
    Exam Registered Students
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Students</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Academic </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Students</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">Exam Registered Students</h4>
        </div>
        <div class="card-body p-0 py-3">
            <!-- Guardians List -->
            <div class="" style="">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Prem number</th>
                        <th>Firstname</th>
                        <th>Middlename</th>
                        <th>Lastname</th>
                        <th>Gender</th>
                        <th>Created by</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $key=>$s)
                        <tr>
                            <td style="width: 29px;">{{++$key}}</td>
                            <td class="fw-bolder">{{$s->prem_number}}</td>
                            <td>{{$s->firstname}}</td>
                            <td>{{$s->middlename}}</td>
                            <td>{{$s->lastname}}</td>
                            <td>{{$s->gender}}</td>
                            <td>{{\Carbon\Carbon::parse($s->created_at)->format('d M Y H:m')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /Guardians List -->
        </div>
    </div>
    <!-- /Guardians List -->
@endsection

@section('extra-script')
    <script>

    </script>
@endsection
