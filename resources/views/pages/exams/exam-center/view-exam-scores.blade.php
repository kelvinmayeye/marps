<div class="flex-fill border-start ps-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pt-3 mb-3">
        <div class="mb-3">
            <h5>Examination Scores</h5>
            <p>Scores for {{$exam_registration->exam->name}} by {{auth()->user()->school->name}}</p>
        </div>
    </div>
    <div class="d-md-flex d-block">
        <div class="flex-fill">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>{{$exam_registration->exam->name}} Results</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-2">
                        @if(empty($exam_registration->approved_by))
                            <button type="button" class="btn btn-danger btn-sm" data-exam-registered-id="{{$exam_registration->id??''}}" onclick="approveExamScores(this)">
                                <i class="ti ti-check"></i> Approve
                            </button>
                        @endif
                    </div>
                    <div class="" style="">
                        <table class="table table-bordered table-sm" id="">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Prem #</th>
                                <th>Student name</th>
                                <th>Gender</th>
                                <!-- Display subject scores -->
                                @foreach($examscores['subjects'] as $sub)
                                    <th>{{ $sub['subject_name'] }}</th>
                                @endforeach
                                <th>Points</th><!-- total pints -->
                                <th>Division</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($count = 1)
                            @foreach($examscores['grouped'] as $student)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $student['student_prem_number'] }}</td>
                                    <td>{{ $student['student_name'] }}</td>
                                    <td>{{ $student['gender'] }}</td>

                                    @foreach($examscores['subjects'] as $sub)
                                        <td>
                                            @if(isset($student['scores'][$sub['subject_id']]))
                                                {{ $student['scores'][$sub['subject_id']]['score'] ?? '-' }}
                                                ({{ $student['scores'][$sub['subject_id']]['grade'] ?? '-' }})
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach

                                    <td>{{ $student['total_points'] ?? '-' }}</td>
                                    <td class="fw-bolder text-dark">{{ $student['div'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="row mt-3">
                            <!-- Academic Highlights -->
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2" class="text-center fw-bold text-primary">Academic Highlights</th>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Top Student</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Lowest Student</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Best Subject</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Weakest Subject</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Division Summary -->
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2" class="text-center fw-bold text-primary">Division Summary</th>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Division I</td>
                                        <td>{{$examscores['exam_status']['division_summary']['Division I']??0}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Division II</td>
                                        <td>{{$examscores['exam_status']['division_summary']['Division II']??0}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Division III</td>
                                        <td>{{$examscores['exam_status']['division_summary']['Division III']??0}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Division IV</td>
                                        <td>{{$examscores['exam_status']['division_summary']['Division IV']??0}}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Student Demographics -->
                            <div class="col-md-4">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th colspan="2" class="text-center fw-bold text-primary">Student Summary</th>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Total Students</td>
                                        <td>{{$examscores['summary']['total_students']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Total Male</td>
                                        <td>{{$examscores['summary']['male']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Total Female</td>
                                        <td>{{$examscores['summary']['female']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Subjects</td>
                                        <td>{{$examscores['summary']['total_subjects']??''}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pages.exams.exam-center.modals.upload-students-modal')
@include('pages.exams.exam-center.modals.upload-students-scores-modal')

<script>
    function approveExamScores(obj) {
        let url = `{{route('approve.uploaded.scores')}}`;
        let exam_registration_id = $(obj).data('exam-registered-id') || '';
        let msg = 'Are you sure you want to approve these scores';
        if (typeof exam_registration_id !== 'number' || exam_registration_id <= 0) {
            showError("Failed to get Examination Registered ID. Refresh page and try again");
            return;
        }
        let exam = {_token: `{{csrf_token()}}`, exam_registration_id: exam_registration_id};
        confirmAction(url, exam, msg);
    }
</script>
