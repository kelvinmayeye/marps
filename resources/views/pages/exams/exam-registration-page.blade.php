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
            <h3 class="page-title mb-1">Website Settings</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Website Settings</li>
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
                <a href="company-settings.html" class="d-block rounded p-2 active">Company Settings</a>
                <a href="localization.html" class="d-block rounded p-2">Localization</a>
                <a href="prefixes.html" class="d-block rounded p-2">Prefixes</a>
                <a href="preferences.html" class="d-block rounded p-2">Preferences</a>
                <a href="social-authentication.html" class="d-block rounded p-2">Social Authentication</a>
                <a href="language.html" class="d-block rounded p-2">Language</a>
            </div>
        </div>
        <div class="col-xxl-10 col-xl-9">
            <div class="flex-fill border-start ps-3">
                <form action="company-settings.html">
                    <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pt-3 mb-3">
                        <div class="mb-3">
                            <h5>Company Settings</h5>
                            <p>Provide your company information</p>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-light me-2" type="button">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                    <div class="d-md-flex d-block">
                        <div class="flex-fill">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Company Information</h5>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="d-block d-xl-flex">
                                        <div class="mb-3 flex-fill me-xl-3 me-0">
                                            <label class="form-label">Company Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Company Name">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" placeholder="Enter Phone Number">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Company Email Address</label>
                                        <input type="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="d-block d-xl-flex">
                                        <div class="mb-3 flex-fill me-xl-3 me-0">
                                            <label class="form-label">Fax Number</label>
                                            <input type="email" class="form-control" placeholder="Enter Fax Number">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label class="form-label">Website</label>
                                            <input type="email" class="form-control" placeholder="Enter Website">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Address Information</h5>
                                </div>
                                <div class="card-body pb-1">
                                    <div class="mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Address">
                                    </div>
                                    <div class="d-block d-xl-flex">
                                        <div class="mb-3 flex-fill me-xl-3 me-0">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" placeholder="Enter Country">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label class="form-label">State / Province</label>
                                            <input type="email" class="form-control" placeholder="Enter State">
                                        </div>
                                    </div>
                                    <div class="d-block d-xl-flex">
                                        <div class="mb-3 flex-fill me-xl-3 me-0">
                                            <label class="form-label">City</label>
                                            <input type="email" class="form-control" placeholder="City">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label class="form-label">Postal Code</label>
                                            <input type="email" class="form-control" placeholder="Enter Postal Code">
                                        </div>
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
                                                <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img src="assets/img/logo-small.svg" alt="Img"></span>
                                                <h5>Logo</h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i class="ti ti-edit-circle"></i></a>
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
                                                <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img src="assets/img/logo-small.svg" alt="Img"></span>
                                                <h5>Favicon</h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i class="ti ti-edit-circle"></i></a>
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
                                                <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img src="assets/img/logo-small.svg" alt="Img"></span>
                                                <h5>Icon</h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i class="ti ti-edit-circle"></i></a>
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
                                                <span class="avatar avatar-xl border rounded d-flex align-items-center justify-content-center p-2 me-2"><img src="assets/img/logo-small.svg" alt="Img"></span>
                                                <h5>Dark Logo</h5>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="text-primary border rounded fs-16 p-1 badge badge-primary-hover me-2"><i class="ti ti-edit-circle"></i></a>
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
    <script>
    </script>
@endsection
