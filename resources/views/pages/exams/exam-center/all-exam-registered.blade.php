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
                    <div class="table-responsive" style="height: 300px;">
                        <table class="table datatable" id="DataTables_Table_0">
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
                                    <td><a href="" title="click to view students">{{$er->students->count()}}</a></td>
                                    <td><span class="badge bg-outline-success">Not uploaded</span></td>
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
                                                            <i class="ti ti-download me-2 text-primary"></i> Students Template
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="#" onclick="openUploadStudentModal(this)" data-exam-reg-id="{{$er->id}}" data-exam-name="{{base64_encode($er->exam->name)}}">
                                                            <i class="ti ti-upload me-2 text-primary"></i>Import Students
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
    </div>
</div>

<div class="modal fade" id="uploadStudentModal" tabindex="-1" aria-labelledby="uploadStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadStudentModalLabel">Upload Students For <strong class="ex-name"></strong> Examination </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('students.import')}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" class="exam-reg-id" name="exam_registration_id">
                <div class="modal-body">
                    <div>
                        <h6>Student Upload</h6>
                        <div><small>Select .xlsx file with students to register and upload students</small></div>
                        <div><small class="text-danger">Confirm the Examination details before uploading students</small></div>
                        <div class="row">
                            <div class="mb-3">
                                <input type="file" name="students_file" class="form-control form-control-file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let uploadStudentModal;
    $(document).ready(function () {
    });
    function openUploadStudentModal(obj) {
        let exam_reg_id = $(obj).data('exam-reg-id') || '';
        let exam_name = $(obj).data('exam-name') || '';
        console.log(exam_name);
        exam_name = atob(exam_name);
        $('#uploadStudentModal').find('input[type=hidden].exam-reg-id').val(exam_reg_id);
        $('#uploadStudentModal').find('.ex-name').html(exam_name);
        $('#uploadStudentModal').modal('show');
    }
</script>
