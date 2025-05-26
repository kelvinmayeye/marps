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
                        <th>Grade</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Point</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grades as $key => $g)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $g->grade }}</td>
                            <td>{{ $g->min_score }}</td>
                            <td>{{ $g->max_score }}</td>
                            <td>{{ $g->points }}</td>
                            <td>{{ $g->remarks }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-primary btn-sm" href="#" data-grade-object="{{ base64_encode(json_encode($g)) }}" data-bs-toggle="modal" data-bs-target="#add_grade">
                                        <i class="fa fa-edit"></i>
                                    </a>
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
            let data = button.data('grade-object');

            modal.find('.grade-id').val('');
            modal.find('.grade-name').val('');
            modal.find('.grade-min-score').val('');
            modal.find('.grade-max-score').val('');
            modal.find('.grade-points').val('');
            modal.find('.grade-remarks').val('');

            if (data) {
                data = JSON.parse(atob(data));
                modal.find('.grade-id').val(data.id || '');
                modal.find('.grade-name').val(data.grade || '');
                modal.find('.grade-min-score').val(data.min_score || '');
                modal.find('.grade-max-score').val(data.max_score || '');
                modal.find('.grade-points').val(data.points || '');
                modal.find('.grade-remarks').val(data.remarks || '');
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
