@extends('layouts.master')
@section('page_title')
    All Schools
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">School</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Academic </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Schools</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_school">
                    <i class="ti ti-square-rounded-plus-filled me-2"></i>Add School</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Guardians List -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">All Schools</h4>
        </div>
        <div class="card-body p-0 py-3">
            <!-- Guardians List -->
            <div class="custom-datatable-filter table-responsive" style="">
                <table class="table datatable">
                    <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Registration no</th>
                        <th>Physical Address</th>
                        <th>Postal Address</th>
                        <th>Total Staffs</th>
                        <th>Exam Registered</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schools as $key=>$s)
                        <tr>
                            <td style="width: 29px;">{{++$key}}</td>
                            <td>{{$s->name}}</td>
                            <td>{{$s->registration_no}}</td>
                            <td>{{$s->physical_address??'-'}}</td>
                            <td>{{$s->postal_address ??'-'}}</td>
                            <td><span class="fw-bolder" title="click to view examination" style="cursor: pointer">{{$s->users->count()}}</span></td>
                            <td><span class="fw-bolder" title="click to view examination" style="cursor: pointer">{{$s->examRegistration->count()}}</span></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="" class="btn btn-primary btn-sm" data-subject-object="{{base64_encode(json_encode($s))}}" data-bs-toggle="modal" data-bs-target="#add_school">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('examination.center',['page'=>'all-exam-registered'])}}" class="btn btn-success btn-sm" title="view examination list">
                                        <i class="fa fa-list"></i>
                                    </a>
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
    <div class="modal fade" id="add_school">
        <div class="modal-dialog modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add School</h4>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
                <form action="{{route('schools.save')}}" method="post">
                    @csrf
                    <input type="hidden" class="school-id" name="school_id" value="">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control school-name" name="name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Registration No</label>
                                    <input type="text" name="registration_no" class="form-control registration-no">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Physical Address</label>
                                    <input type="text" name="physical_address" class="form-control physical-address">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Postal Address</label>
                                    <input type="text" name="postal_address" class="form-control postal-address">
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="status-title">
                                        <h5>Status</h5>
                                        <p>Change the Status by toggle </p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input school-is-active" type="checkbox" name="is_active" role="switch" id="switch-sm" checked>
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
    <x-shared.delete-modal />
    <!-- /Delete Modal -->
@endsection

@section('extra-script')
    <script>
        $('#add_school').on('show.bs.modal', function (event) {
            let schoolModal = $('#add_school');
            let button = $(event.relatedTarget)
            let school = button.data('subject-object');
            //clear all values
            schoolModal.find('.school-id').val('');
            schoolModal.find('.school-name').val('');
            schoolModal.find('.registration-no').val('');
            schoolModal.find('.physical-address').val('');
            schoolModal.find('.postal-address').val('');
            schoolModal.find('.school-is-active').prop('checked', true);
            if(school){
                school = atob(school);
                school = JSON.parse(school);

                schoolModal.find('.school-id').val(school.id || '');
                schoolModal.find('.school-name').val(school.name || '');
                schoolModal.find('.registration-no').val(school.registration_no || '');
                schoolModal.find('.physical-address').val(school.physical_address || '');
                schoolModal.find('.postal-address').val(school.postal_address || '');
                schoolModal.find('.school-is-active').prop('checked', school.is_active === 1);
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
    </script>
@endsection
