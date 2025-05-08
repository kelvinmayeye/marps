<div class="flex-fill border-start ps-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pt-3 mb-3">
        <div class="mb-3">
            <h5>Examination Registration</h5>
            <p>All Examinations registered by {{auth()->user()->school->name}}</p>
        </div>
    </div>
    <div class="d-md-flex d-block">
        <div class="flex-fill">
            <div class="card">
                <div class="card-header">
                    <h5>Registered Examination List</h5>
                </div>
                <div class="card-body">
                    <div class="" style="height: 300px;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Total Subjects</th>
                                <th>Registered by</th>
                                <th>Registered Students</th>
                                <th>Results Uploaded</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($count = 1)
                            @foreach($examRegisteredhistory as $er)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$er->exam->name}}</td>
                                    <td>{{$er->subjects->count()}}</td>
                                    <td>{{$er->createdby->name}}</td>
                                    <td>0</td>
                                    <td><span class="badge bg-outline-success">Yes</span></td>
                                    <td><span class="badge bg-soft-primary">{{$er->status}}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical fs-14"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right p-1" style="">
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="{{route('download.register.students.template')}}">
                                                            <i class="ti ti-download me-2 text-primary"></i>Students Template
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="#">
                                                            <i class="ti ti-thumb-up me-2 text-danger"></i>Confirm Students
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="#" title="click to download score template">
                                                            <i class="ti ti-file-download me-2 text-primary"></i>Score Template
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="#" title="click to download score template">
                                                            <i class="ti ti-checks me-2 text-success"></i>Approve Score
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
