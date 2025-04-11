@extends('layouts.master')
@section('page_title')
   All Exams
@endsection
@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Exams</h3>
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
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_exam">
                    <i class="ti ti-square-rounded-plus-filled me-2"></i>Add Exams</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Exams</h4>
        </div>
        <div class="card-body p-0 py-3">
            <!-- Guardians List -->
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Total Subjects</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exams as $key=>$e)
                        <tr>
                            <td style="width: 29px;">{{++$key}}</td>
                            <td>{{$e->name}}</td>
                            <td>{{$e->exam_type_name??null}}</td>
                            <td>{{$e->exam_subject_count }}</td>
                            <td>
                                <span class="badge {{($e->is_active)?'badge-soft-success':'badge-soft-danger'}} d-inline-flex align-items-center">
                                    <i class="ti ti-circle-filled fs-5 me-1"></i>{{($e->is_active)?'Active':'Inactive'}}</span>
                            </td>
                            <td>{{$e->creator_name}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-14"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right p-3">
                                            <li><a class="dropdown-item rounded-1" href="#" data-exam-object="{{base64_encode(json_encode($e))}}" data-bs-toggle="modal" data-bs-target="#add_exam">
                                                    <i class="ti ti-edit-circle me-2"></i>Edit</a>
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

    <!-- Add Exam -->
    <div class="modal fade" id="add_exam">
        <div class="modal-dialog modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Exam</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('exam.save')}}" method="post">
                    @csrf
                    <input type="hidden" class="exam-id" name="exam_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control exam-name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Exam types</label>
                                    <select name="exam_type_id" class="form-select exam-type" required>
                                        <option value="" selected>-- select type--</option>
                                        @foreach($examTypes as $et)
                                            <option value="{{$et->id}}">{{$et->name??null}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="status-title">
                                        <h5>Status</h5>
                                        <p>Change the Status by toggle </p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input exam-status" type="checkbox" name="is_active" role="switch" id="switch-sm" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div><h5 class="text-danger-emphasis">Exams Subjects</h5></div>
                                <div class="table-responsive">
                                    <table class="table text-nowrap table-sm exam-subject-table">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="checke-all">
                                                    <label class="form-check-label" for="checke-all">
                                                    </label>
                                                </div>
                                            </th>
                                            <th scope="col">Subject</th>
                                            <th scope="col">Code</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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
    <x-shared.delete-modal />
    <!-- /Delete Modal -->
@endsection

@section('extra-script')
    <script>
        $('#add_exam').on('show.bs.modal', function (event) {
            let examModal = $('#add_exam');
            let button = $(event.relatedTarget)
            let ac_exam = button.data('exam-object');
            let row = ``;
            //clear all values
            examModal.find('.exam-id').val('');
            examModal.find('.exam-name').val('');
            examModal.find('.exam-type').val('');
            examModal.find('.exam-status').prop('checked', true);
            $('.exam-subject-table tbody').empty();
            if(ac_exam){
                ac_exam = atob(ac_exam);
                ac_exam = JSON.parse(ac_exam);

                examModal.find('.exam-id').val(ac_exam.id || '');
                examModal.find('.exam-name').val(ac_exam.name || '');
                examModal.find('.exam-type').val(ac_exam.exam_type_id || '');
                examModal.find('.exam-status').prop('checked', ac_exam.is_active === 1);
                $.get("{{ route('ajax.exam.subject.list') }}", { exam_id: 1 }, function(results) {
                    if(results.status === 'success'){
                        $.each(results.data, function(i, e) {
                            let isChecked = e.checked == 1 ? 'checked' : '';
                            let row = `<tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="${e.id}" name="exam_subjects[${e.id}]" id="checkbox-sm-${i}" ${isChecked}>
                                                    <label class="form-check-label" for="checkbox-sm-${i}"></label>
                                                </div>
                                            </td>
                                            <td><span>${e.name || ''}</span></td>
                                            <td><span>${e.code || ''}</span></td>
                                        </tr>`;
                            $('.exam-subject-table tbody').append(row);
                        });

                        console.log(results);
                    }else {
                        console.log(results);
                    }
                });
            }
        });
    </script>
@endsection
