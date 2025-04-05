@extends('layouts.master')

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Subjects</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Academic </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Subjects</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_subject">
                    <i class="ti ti-square-rounded-plus-filled me-2"></i>Add Subject</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Subjects</h4>
        </div>
        <div class="card-body p-0 py-3">
            <!-- Guardians List -->
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $key=>$s)
                        <tr>
                            <td style="width: 29px;">{{++$key}}</td>
                            <td>{{$s->name}}</td>
                            <td>{{$s->code}}</td>
                            <td>
                                <span class="badge {{($s->status)?'badge-soft-success':'badge-soft-danger'}} d-inline-flex align-items-center">
                                    <i class="ti ti-circle-filled fs-5 me-1"></i>{{($s->status)?'Active':'Inactive'}}</span>
                            </td>
                            <td>{{$s->creator->name ?? 'N/A'}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-14"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right p-3">
                                            <li><a class="dropdown-item rounded-1" href="#" data-subject-object="{{base64_encode(json_encode($s))}}" data-bs-toggle="modal" data-bs-target="#add_subject">
                                                    <i class="ti ti-edit-circle me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item rounded-1" href="#" data-subject-id="{{$s->id}}" onclick="openDeleteModal(this)">
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
    <div class="modal fade" id="add_subject">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Subject</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('subject.save')}}" method="post">
                    @csrf
                    <input type="hidden" class="sub-id" name="subject_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control sub-name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="code" class="form-control sub-code">
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="status-title">
                                        <h5>Status</h5>
                                        <p>Change the Status by toggle </p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input sub-status" type="checkbox" name="status" role="switch" id="switch-sm" checked>
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

    <!-- Delete Modal -->
    <div class="modal fade" id="delete-subject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{route('subject.delete')}}" method="post">
                    @csrf
                    <input type="hidden" id="delete-subject-id" name="subject_id" value="">
                    <div class="modal-body text-center">
							<span class="delete-icon p-2 text-danger" style="">
								<i class="ti ti-trash-x fs-2"></i>
							</span>
                        <h4>Confirm Deletion</h4>
                        <p>You want to delete all the marked items, this cant be undone once you delete.</p>
                        <div class="d-flex justify-content-center">
                            <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
@endsection

@section('extra-script')
    <script>
        $('#add_subject').on('show.bs.modal', function (event) {
            let subjectModal = $('#add_subject');
            let button = $(event.relatedTarget)
            let subject = button.data('subject-object');
            //clear all values
            subjectModal.find('.sub-id').val('');
            subjectModal.find('.sub-name').val('');
            subjectModal.find('.sub-code').val('');
            subjectModal.find('.sub-status').prop('checked', true);
            if(subject){
                subject = atob(subject);
                subject = JSON.parse(subject);

                subjectModal.find('.sub-id').val(subject.id || '');
                subjectModal.find('.sub-name').val(subject.name || '');
                subjectModal.find('.sub-code').val(subject.code || '');
                subjectModal.find('.sub-status').prop('checked', subject.status === 1);
            }
        });

        function openDeleteModal(obj) {
            let subjectId = $(obj).attr('data-subject-id');
            // //Todo validate if subject id is empty
            $('#delete-subject-id').val('').val(subjectId);
            $('#delete-subject-modal').modal('show');
            // if(subjectId.length === 0)
            //Todo:send kwa ajax

        }
    </script>
@endsection
