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
                        <button type="button" class="btn btn-danger btn-sm" data-exam-registered-id="{{$exam_registration->id??''}}" onclick="approveExamScores(this)">
                            <i class="ti ti-check"></i> Approve
                        </button>
                    </div>
                    <div class="" style="">
                        <table class="table table-bordered table-sm" id="">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Prem #</th>
                                <th>Student name</th>
                                <th>Gender</th>
                                <!-- Loop all subjects -->
                                @foreach($examscores['subjects'] as $sub)
                                    <th>{{ $sub['subject_name'] }}</th>
                                @endforeach
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

                                    <!-- Display subject scores -->
                                    @foreach($examscores['subjects'] as $sub)
                                        <td>
                                            {{ $student['scores'][$sub['subject_id']] ?? '-' }}
                                        </td>
                                    @endforeach
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
    function approveExamScores(obj){
        let url = `{{route('approve.uploaded.scores')}}`;
        let exam_registration_id = $(obj).data('exam-registered-id') || '';
        let msg = 'Are you sure you want to approve these scores';
        if (typeof exam_registration_id !== 'number' || exam_registration_id <= 0) {
            showError("Failed to get Examination Registered ID. Refresh page and try again");
            return;
        }
        let exam = {_token:`{{csrf_token()}}`,exam_registration_id:exam_registration_id};
        confirmAction(url, exam, msg);
    }
</script>
