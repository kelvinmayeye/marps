@extends('layouts.master')
@section('page_title')
    Users Requests
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">User Requests</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">User Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users Request</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">Users Requests</h4>
        </div>
        <div class="card-body p-0 py-3">
            <!-- Guardians List -->
            <div class="custom-datatable-filter table-responsive" style="">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>School</th>
                        <th>Title</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$s)
                        <tr>
                            <td style="width: 29px;">{{++$key}}</td>
                            <td>{{ ($s->title ?? '') .' '. ($s->name ?? '') }}</td>
                            <td>{{$s->username}}</td>
                            <td>{{''}}</td>
                            <td>{{$s->school_position}}</td>
                            <td>{{$s->role->name}}</td>
                            <td>{{$s->phone_number}}</td>
                            <td>{{$s->email}}</td>
                            <td>{{$s->status}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-14"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right p-3">
                                            <li>
                                                <a class="dropdown-item rounded-1" href="#" data-user-data="{{base64_encode(json_encode($s))}}" onclick="AcceptRequest(this)">
                                                    <i class="ti ti-circle-check me-2 text-primary"></i>Accept
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item rounded-1" href="#" data-subject-object="{{base64_encode(json_encode($s))}}" data-bs-toggle="modal" data-bs-target="#add_user">
                                                    <i class="ti ti-ban me-2 text-danger"></i>Reject
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /Guardians List -->
        </div>
    </div>
    <!-- /Guardians List -->
    <script>
        function AcceptRequest(obj){
            let user_data = $(obj).data('user-data');
            user_data = atob(user_data);
            user_data = JSON.parse(user_data);
            console.log(user_data);
            let msg = `Are sure you want to Accept ${user_data.name} request`;
            let user = {_token:`{{csrf_token()}}`,user_id:user_data.id};
            confirmAction(`{{route('users.accept.account.request')}}`, user, msg);
        }
    </script>
@endsection

@section('extra-script')

@endsection
