@extends('layouts.master')
@section('page_title')
    All Users
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Users</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user">
                    <i class="ti ti-square-rounded-plus-filled me-2"></i>Add User</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Users</h4>
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
                        <th>Token</th>
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
                            <td>{{$s->school->name??''}}</td>
                            <td>{{$s->school_position}}</td>
                            <td>{{$s->role->name}}</td>
                            <td>{{$s->phone_number}}</td>
                            <td><span class="fw-bolder text-danger" title="User should user this token on first login">{{$s->remember_token??null}}</span></td>
                            <td>
                                <div class="text-center">
                                     <span class="badge
                                         {{ $s->status == 'active' ? 'badge-success' :
                                            ($s->status == 'accepted' ? 'badge-primary' : 'badge-danger') }}">
                                         {{ $s->status }}
                                     </span>
                                </div>
                            </td>
                            <td>
                                @if($s->status !== 'rejected')
                                    @if($s->id !== 1)
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical fs-14"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right p-3">
                                                    <li><a class="dropdown-item rounded-1" href="#" data-subject-object="{{base64_encode(json_encode($s))}}" data-bs-toggle="modal"
                                                           data-bs-target="#add_user">
                                                            <i class="ti ti-edit-circle me-2"></i>Edit</a>
                                                    </li>

                                                    <li><a class="dropdown-item rounded-1" href="#" data-subject-object="{{base64_encode(json_encode($s))}}" data-bs-toggle="modal"
                                                           data-bs-target="#add_user">
                                                            <i class="ti ti-eye me-2"></i>View</a>
                                                    </li>
                                                    @if($s->status == 'accepted')
                                                        <li><a class="dropdown-item rounded-1" href="#">
                                                                <i class="ti ti-recycle me-2 text-success-emphasis"></i>Resend Token</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                @endif
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

    <!-- Add User -->
    @include('pages.users.modal.add-user-modal')
    <!-- /Add User -->

    <!-- Delete Modal -->
    <x-shared.delete-modal/>
    <!-- /Delete Modal -->
@endsection

@section('extra-script')
    <script>
        $('#add_user').on('show.bs.modal', function (event) {
            let userModal = $('#add_user');
            let button = $(event.relatedTarget)
            let user = button.data('subject-object');
            //clear all values
            userModal.find('.user-id').val('');
            userModal.find('.user-name').val('');
            userModal.find('.user-title').val('');
            userModal.find('.username').val('');
            userModal.find('.user-email').val('');
            userModal.find('.user-phone-number').val('');
            userModal.find('.user-school-id').val('');
            userModal.find('.user-school-position').val('');
            userModal.find('.user-role').val('');

            //userModal.find('.user-phone-number').prop('checked', true);
            if (user) {
                user = atob(user);
                user = JSON.parse(user);
                userModal.find('.user-id').val(user.id || '');
                userModal.find('.user-name').val(user.name || '');
                userModal.find('.user-title').val(user.title || '');
                userModal.find('.username').val(user.username || '');
                userModal.find('.user-email').val(user.email || '');
                userModal.find('.user-phone-number').val(user.phone_number || '');
                userModal.find('.user-school-id').val(user.school_id || '');
                userModal.find('.user-school-position').val(user.school_position || '');
                userModal.find('.user-role').val(user.role_id || '');
                // userModal.find('.user-is-active').prop('checked', user.is_active === 1);
            }
        });

        function openDeleteModal(obj) {
            let deleteModal = $('#delete-object-modal');
            let objectId = $(obj).attr('data-to-delete-object-id');
            let DeleteTitle = $(obj).attr('data-delete-subject');
            let deleteRoute = `{{route('subject.delete')}}`;
            // //Todo validate if subject id is empty
            $('#delete-object-id').val('').val(objectId);
            //append the route to form
            $('#modal-delete-form').attr('action', deleteRoute);
            deleteModal.modal('show');
            //Todo:send kwa ajax

        }

        function autoFillUsername(obj) {
            let parent = $('#add_user');
            let userId = $(parent).find('.user-id').val() || '';
            let name = $(obj).val() || '';
            let first_name = '';
            if (userId.length < 1) $(parent).find('.username').val('');
            if (userId.length < 1 && name.length > 0) {
                first_name = name.trim().split(' ')[0];
                $(parent).find('.username').val('').val(first_name);
            }
        }
    </script>
@endsection
