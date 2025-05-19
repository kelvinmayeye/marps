@extends('layouts.master')
@section('page_title')
    All Grades
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Grades</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Grades</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_grade">
                    <i class="ti ti-square-rounded-plus-filled me-2"></i>Add Grade</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Grades List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Grades</h4>
        </div>
        <div class="card-body p-0 py-3">
            <div class="custom-datatable-filter table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Remark</th>
                        <th>From (%)</th>
                        <th>To (%)</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grades as $key => $g)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $g->name }}</td>
                            <td>{{ $g->points }}</td>
                            <td>{{ $g->remark }}</td>
                            <td>{{ $g->from_mark }}</td>
                            <td>{{ $g->to_mark }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-14"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right p-3">
                                            <li>
                                                <a class="dropdown-item rounded-1" href="#" data-subject-object="{{ base64_encode(json_encode($g)) }}" data-bs-toggle="modal" data-bs-target="#add_grade">
                                                    <i class="ti ti-edit-circle me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item rounded-1 text-danger" href="#" onclick="openDeleteModal(this)" data-to-delete-object-id="{{ $g->id }}" data-delete-subject="Grade: {{ $g->name }}">
                                                    <i class="ti ti-trash me-2"></i>Delete
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
        </div>
    </div>
    <!-- /Grades List -->

    <!-- Add Grade -->
    @include('pages.academics.modal.add-academic-grade-modal')
    <!-- /Add Grade -->

    <!-- Delete Modal -->
    <x-shared.delete-modal />
    <!-- /Delete Modal -->
@endsection

@section('extra-script')
    <script>
        $('#add_grade').on('show.bs.modal', function (event) {
            let modal = $('#add_grade');
            let button = $(event.relatedTarget);
            let data = button.data('subject-object');

            modal.find('.grade-id').val('');
            modal.find('.grade-name').val('');
            modal.find('.grade-points').val('');
            modal.find('.grade-remark').val('');
            modal.find('.grade-from-mark').val('');
            modal.find('.grade-to-mark').val('');

            if (data) {
                data = JSON.parse(atob(data));
                modal.find('.grade-id').val(data.id || '');
                modal.find('.grade-name').val(data.name || '');
                modal.find('.grade-points').val(data.points || '');
                modal.find('.grade-remark').val(data.remark || '');
                modal.find('.grade-from-mark').val(data.from_mark || '');
                modal.find('.grade-to-mark').val(data.to_mark || '');
            }
        });

        function openDeleteModal(obj) {
            let deleteModal = $('#delete-object-modal');
            let objectId = $(obj).attr('data-to-delete-object-id');
            let deleteTitle = $(obj).attr('data-delete-subject');
            let deleteRoute = `{{ route('grade.delete') }}`;

            $('#delete-object-id').val(objectId);
            $('#modal-delete-form').attr('action', deleteRoute);
            deleteModal.modal('show');
        }
    </script>
@endsection
