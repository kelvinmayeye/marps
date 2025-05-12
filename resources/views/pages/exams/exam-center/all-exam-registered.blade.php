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
                        <table class="table " id="">
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
                                    <td>
                                        @if($er->students->count() > 0)
                                            <a href="{{ route('view.exam.registered.students', ['exam_registration_id' => $er->id]) }}" title="click to view students">
                                                {{ $er->students->count() }}
                                            </a>
                                        @else
                                            <a href="#" onclick="return false;" style="cursor: not-allowed;" title="No students registered">
                                                {{ $er->students->count() }}
                                            </a>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-outline-success">Not uploaded</span></td>
                                    <td><span class="badge bg-soft-primary">{{$er->status}}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-white btn-icon btn-sm d-flex align-items-center justify-content-center rounded-circle p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical fs-14"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="">
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="{{route('download.register.students.template')}}">
                                                            <i class="ti ti-file-download me-2 text-primary"></i> Students Template
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="#" onclick="openUploadStudentModal(this)" data-exam-reg-id="{{$er->id}}" data-exam-name="{{base64_encode($er->exam->name)}}">
                                                            <i class="ti ti-file-upload me-2 text-primary"></i>Import Students
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="{{route('download.students.score.template',['exam_reg_id'=>$er->id])}}" title="click to download score template">
                                                            <i class="ti ti-file-download me-2 text-primary"></i>Score Template
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item rounded-1" href="#" onclick="openUploadStudentScoresModal(this)" data-exam-reg-id="{{$er->id}}" data-exam-name="{{base64_encode($er->exam->name)}}">
                                                            <i class="ti ti-thumb-up me-2 text-danger"></i>Upload Scores
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

@include('pages.exams.exam-center.modals.upload-students-modal')
@include('pages.exams.exam-center.modals.upload-students-scores-modal')

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

    function openUploadStudentScoresModal(obj) {
        let exam_reg_id = $(obj).data('exam-reg-id') || '';
        let exam_name = $(obj).data('exam-name') || '';
        console.log(exam_name);
        exam_name = atob(exam_name);
        $('#uploadStudentScoresModal').find('input[type=hidden].exam-reg-id').val(exam_reg_id);
        $('#uploadStudentScoresModal').find('.ex-name').html(exam_name);
        $('#uploadStudentScoresModal').modal('show');
    }
</script>
