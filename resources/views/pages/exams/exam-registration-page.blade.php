@extends('layouts.master')
@section('page_title')
    All Exams
@endsection
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between border-bottom pb-3">
        <div class="my-auto mb-2">
            {{-- TODO: This page will serve the following purposes:
                        1. Allow schools to register for the exams they intend to participate in.
                        2. Enable selection of an exam and assignment of participating students, with optional approval (not a priority for now).
                        3. Provide downloadable Excel templates pre-filled with selected students.
                        4. Facilitate the upload of student scores using the provided templates.
                        5. Automatically compute and generate academic results for each registered school based on the submitted scores.
              --}}
            <h3 class="page-title mb-1">Examination Center</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Examination</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Examination center</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="pe-1 mb-2">
                <a href="" class="btn btn-outline-light bg-white btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                    <i class="ti ti-refresh"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-2 col-xl-3">
            <div class="pt-3 d-flex flex-column list-group mb-4">
                <a href="" class="d-block rounded p-2 active">Exam Registration</a>
                <a href="" class="d-block rounded p-2">Localization</a>
                <a href="" class="d-block rounded p-2">Prefixes</a>
                <a href="" class="d-block rounded p-2">Preferences</a>
                <a href="" class="d-block rounded p-2">Social Authentication</a>
                <a href="" class="d-block rounded p-2">Language</a>
            </div>
        </div>
        <div class="col-xxl-10 col-xl-9">
            <div class="flex-fill border-start ps-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pt-3 mb-3">
                    <div class="mb-3">
                        <h5>Examination Registration</h5>
                        <p>Provide your school to register exam</p>
                    </div>
                </div>
                <div class="d-md-flex d-block">
                    <div class="flex-fill">
                        <div class="card">
                            <div class="card-header">
                                <h5>School Information</h5>
                                <span><small>(#auto filled basing on user account)</small></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <label class="form-label">School name</label>
                                        <input type="text" value="{{$userSchoolInfo->name}}" class="form-control" placeholder="Enter School Name" readonly>
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <label class="form-label">Registration Number</label>
                                        <input type="text" value="{{$userSchoolInfo->registration_no}}" class="form-control" placeholder="Enter Registration Number" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 mb-3">
                                        <label class="form-label">Physical Address</label>
                                        <input type="text" value="{{$userSchoolInfo->physical_address}}" class="form-control" placeholder="Physical Address" readonly>
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <label class="form-label">Postal Address</label>
                                        <input type="text" value="{{$userSchoolInfo->postal_address}}" class="form-control" placeholder="Postal Address" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5>Exam Registration</h5>
                            </div>
                            <div class="card-body">
                                <small>(#show previous examination registration/participation)</small>

                                <form action="{{route('save.exam.registration')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Examination <small>(#add select2)</small></label>
                                            <select name="examination_id" class="form-control" onchange="getExamSubject(this)">
                                                <option value="" selected>select examination</option>
                                                @foreach(\App\Models\Admin\Exam::all() as $e)
                                                    <option value="{{$e->id}}">{{$e->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <small>(#show all subjects (with checkbox) related to the selected examination)</small>
                                            <div class="mt-2 row subject-holder">

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-flex justify-content-end gap-3">
                                                <a href="" class="btn btn-warning" type="submit">clear</a>
                                                <button class="btn btn-primary" type="submit">save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="settings-right-sidebar ms-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Company Images</h5>
                            </div>
                            <div class="card-body">
                                <div class="border-bottom mb-3 pb-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img
                                                    src="assets/img/logo-small.svg" alt="Img"></span>
                                            <h5>Logo</h5>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i
                                                    class="ti ti-edit-circle"></i></a>
                                            <a href="javascript:void(0);" class="text-danger border rounded fs-16 p-1 badge badge-danger-hover"><i class="ti ti-trash-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="profile-uploader profile-uploader-two mb-0">
                                        <span class="d-block text-center lh-1 fs-24 mb-1"><i class="ti ti-upload"></i></span>
                                        <div class="drag-upload-btn bg-transparent me-0 border-0">
                                            <p class="fs-12 mb-2"><span class="text-primary">Click to Upload</span> or drag and drop
                                            </p>
                                            <h6>JPG or PNG</h6>
                                            <h6>(Max 450 x 450 px)</h6>
                                        </div>
                                        <input type="file" class="form-control image-sign" multiple="">
                                        <div class="frames"></div>
                                    </div>
                                </div>
                                <div class="border-bottom mb-3 pb-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img
                                                    src="assets/img/logo-small.svg" alt="Img"></span>
                                            <h5>Favicon</h5>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i
                                                    class="ti ti-edit-circle"></i></a>
                                            <a href="javascript:void(0);" class="text-danger border rounded fs-16 p-1 badge badge-danger-hover"><i class="ti ti-trash-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="profile-uploader profile-uploader-two mb-0">
                                        <span class="d-block text-center lh-1 fs-24 mb-1"><i class="ti ti-upload"></i></span>
                                        <div class="drag-upload-btn bg-transparent me-0 border-0">
                                            <p class="fs-12 mb-2"><span class="text-primary">Click to Upload</span> or drag and drop
                                            </p>
                                            <h6>JPG or PNG</h6>
                                            <h6>(Max 450 x 450 px)</h6>
                                        </div>
                                        <input type="file" class="form-control" multiple="" id="image_sign2">
                                        <div id="frames2"></div>
                                    </div>
                                </div>
                                <div class="border-bottom mb-3 pb-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img
                                                    src="assets/img/logo-small.svg" alt="Img"></span>
                                            <h5>Icon</h5>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i
                                                    class="ti ti-edit-circle"></i></a>
                                            <a href="javascript:void(0);" class="text-danger border rounded fs-16 p-1 badge badge-danger-hover"><i class="ti ti-trash-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="profile-uploader profile-uploader-two mb-0">
                                        <span class="d-block text-center lh-1 fs-24 mb-1"><i class="ti ti-upload"></i></span>
                                        <div class="drag-upload-btn bg-transparent me-0 border-0">
                                            <p class="fs-12 mb-2"><span class="text-primary">Click to Upload</span> or drag and drop
                                            </p>
                                            <h6>JPG or PNG</h6>
                                            <h6>(Max 450 x 450 px)</h6>
                                        </div>
                                        <input type="file" class="form-control" multiple="" id="image_sign3">
                                        <div id="frames3"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img
                                                    src="assets/img/logo-small.svg" alt="Img"></span>
                                            <h5>Dark Logo</h5>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i
                                                    class="ti ti-edit-circle"></i></a>
                                            <a href="javascript:void(0);" class="text-danger border rounded fs-16 p-1 badge badge-danger-hover"><i class="ti ti-trash-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="profile-uploader profile-uploader-two mb-0">
                                        <span class="d-block text-center lh-1 fs-24 mb-1"><i class="ti ti-upload"></i></span>
                                        <div class="drag-upload-btn bg-transparent me-0 border-0">
                                            <p class="fs-12 mb-2"><span class="text-primary">Click to Upload</span> or drag and drop
                                            </p>
                                            <h6>JPG or PNG</h6>
                                            <h6>(Max 450 x 450 px)</h6>
                                        </div>
                                        <input type="file" class="form-control" multiple="" id="image_sign4">
                                        <div id="frames4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function getExamSubject(obj) {
            let exam_id = $(obj).val() || '';
            let checkbox = '';
            let holder_checkbox = $('div.subject-holder');

            holder_checkbox.empty();
            if (exam_id.length < 1) return;

            $.get(`{{ route('ajax.exam.subject.list') }}`, {exam_id: exam_id}, (result) => {
                if (result.status === 'success') {
                    $.each(result.data, function (index, subject) {
                        checkbox = `<div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" name="subject[${subject.id}]" type="checkbox" value="${subject.id}" id="subject${subject.id}">
                        <label class="form-check-label" for="subject${subject.id}">${subject.name}</label>
                    </div>
                </div>`;
                        holder_checkbox.append(checkbox);
                    });
                } else {
                    showError(result.msg || 'An error occurred on getting exam subject');
                }
            });
        }
    </script>
@endsection

@section('extra-script')

@endsection
