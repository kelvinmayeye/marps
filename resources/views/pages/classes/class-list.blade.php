@extends('layouts.master')

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Classes</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Academic </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Classes</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_class">
                    <i class="ti ti-square-rounded-plus-filled me-2"></i>Add Class</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Classes</h4>
        </div>
        <div class="card-body p-0 py-3">
            <!-- Guardians List -->
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($classes as $key=>$c)
                        <tr>
                            <td style="width: 29px;">{{++$key}}</td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->level}}</td>
                            <td>
                                <span class="badge {{($c->status)?'badge-soft-success':'badge-soft-danger'}} d-inline-flex align-items-center">
                                    <i class="ti ti-circle-filled fs-5 me-1"></i>{{($c->status)?'Active':'Inactive'}}</span>
                            </td>
                            <td>{{$c->creator->name ?? 'N/A'}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-14"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right p-3">
                                            <li><a class="dropdown-item rounded-1" href="#" data-class-object="{{base64_encode(json_encode($c))}}" data-bs-toggle="modal" data-bs-target="#add_class">
                                                    <i class="ti ti-edit-circle me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item rounded-1" href="#" data-bs-toggle="modal" data-bs-target="#delete-modal">
                                                    <i class="ti ti-trash-x me-2"></i>Delete</a>
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

    <!-- Add Subject -->
    <div class="modal fade" id="add_class">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Class</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('class.save')}}" method="post">
                    @csrf
                    <input type="hidden" class="class-id" name="class_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control class-name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Level</label>
                                    <select name="level" class="form-select class-level" required>
                                        <option value="" selected>-- select level--</option>
                                        <option value="Primary">Primary</option>
                                        <option value="Sec O-Level">Sec O-level</option>
                                        <option value="Sec A-Level">Sec A-level</option>
                                    </select>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="status-title">
                                        <h5>Status</h5>
                                        <p>Change the Status by toggle </p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input class-status" type="checkbox" name="status" role="switch" id="switch-sm" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary me-2">Save</button>
                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Subject -->
@endsection

@section('extra-script')
    <script>
        $('#add_class').on('show.bs.modal', function (event) {
            let classModal = $('#add_class');
            let button = $(event.relatedTarget)
            let ac_class = button.data('class-object');
            //clear all values
            classModal.find('.class-id').val('');
            classModal.find('.class-name').val('');
            classModal.find('.class-level').val('');
            classModal.find('.class-status').prop('checked', true);
            if(ac_class){
                ac_class = atob(ac_class);
                ac_class = JSON.parse(ac_class);

                classModal.find('.class-id').val(ac_class.id || '');
                classModal.find('.class-name').val(ac_class.name || '');
                classModal.find('.class-level').val(ac_class.level || '');
                classModal.find('.class-status').prop('checked', ac_class.status === 1);
            }
        });
    </script>
@endsection
