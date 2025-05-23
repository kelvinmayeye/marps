@extends('layouts.master')
@section('page_title')
    Roles and Permissions
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
            <h4 class="mb-3">Roles &amp; Permissions List</h4>
        </div>

        <div class="card-body p-0 py-3">
            <form action="{{ route('save.role.permission') }}" method="POST">
                @csrf

                <div class="table-responsive px-3">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permission</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rolesWithPermissions as $role)
                            <tr>
                                <td>{{ $role['name'] }}</td>
                                <td>
                                    <!-- Hidden input ensures role is submitted even if no checkboxes are selected -->
                                    <input type="hidden" name="permissions[{{ $role['id'] }}]" value="">

                                    @foreach(array_chunk($role['role_permissions'], 4) as $permissionChunk)
                                        <div class="row">
                                            @foreach($permissionChunk as $permission)
                                                <div class="col-md-3">
                                                    <label class="checkboxs">
                                                        {{ $permission['name'] }}
                                                        <input type="checkbox" class="border border-1 border-primary" name="permissions[{{ $role['id'] }}][]" value="{{ $permission['id'] }}" {{$permission['is_checked'] ? 'checked':''}}>
                                                        <span class="checkmarks"></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="row mt-2">
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        @endsection

        @section('extra-script')
            <script>


            </script>
@endsection
