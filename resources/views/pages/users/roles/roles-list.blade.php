@extends('layouts.master')
@section('page_title')
    All Roles
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Roles &amp; Permissions</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">User Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Roles &amp; Permissions</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                <a href="#" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#add_role">
                    <i class="ti ti-square-rounded-plus me-2"></i>Add Role</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Filter Section -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Roles</h4>
        </div>

        <div class="card-body p-0 py-3">
            <div class="custom-datatable-filter table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row dt-row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table datatable dataTable no-footer" id="DataTables_Table_0">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th class="sorting">Role Name</th>
                                    <th class="sorting">Created On</th>
                                    <th class="sorting">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($cnt=1)
                                @foreach($roles as $r)
                                    <tr class="">
                                        <td class="">{{$cnt++}}</td>
                                        <td>{{$r->name}}</td>
                                        <td>{{$r->created_at}}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="btn btn-outline-light bg-white btn-icon d-flex align-items-center justify-content-center rounded-circle  p-0 me-2"
                                                   data-bs-toggle="modal" data-bs-target="#add_role" data-role-object="{{base64_encode(json_encode($r))}}">
                                                    <i class="ti ti-edit-circle text-primary"></i>
                                                </a>
                                                <a href="{{route('roles.permissions')}}" class="btn btn-outline-light bg-white btn-icon d-flex align-items-center justify-content-center rounded-circle  p-0 me-2">
                                                    <i class="ti ti-user-bolt text-success"></i>
                                                </a>
                                                <a href="#" class="btn btn-outline-light bg-white btn-icon d-flex align-items-center justify-content-center rounded-circle p-0 me-3"
                                                   data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                    <i class="ti ti-trash-x text-danger"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /Role Permission List -->
                    </div>
                </div>
            </div>
        </div>


        @include('pages.users.roles.add-role-modal')
        @endsection

        @section('extra-script')
            <script>
                $('#add_role').on('show.bs.modal', function (event) {
                    let roleModal = $('#add_role');
                    let button = $(event.relatedTarget)
                    let role = button.data('role-object');
                    //clear all values
                    roleModal.find('.role-id').val('');
                    roleModal.find('.role-name').val('');
                    if (role) {
                        role = atob(role);
                        role = JSON.parse(role);
                        roleModal.find('.role-id').val(role.id || '');
                        roleModal.find('.role-name').val(role.name || '');
                    }
                });

            </script>
@endsection
