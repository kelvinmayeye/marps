<div class="flex-fill border-start ps-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pt-3 mb-3">
        <div class="mb-3">
            <h5>Examination Scored</h5>
            <p>scores for {exam-name} by {{auth()->user()->school->name}}</p>
        </div>
    </div>
    <div class="d-md-flex d-block">
        <div class="flex-fill">
            <div class="card">
                <div class="card-header">
                    <h5>Examination {name} Results</h5>
                </div>
                <div class="card-body">
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
    $(document).ready(function () {

    });
</script>
