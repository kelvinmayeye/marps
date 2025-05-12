<div class="modal fade" id="uploadStudentScoresModal" tabindex="-1" aria-labelledby="uploadStudentScoresModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadStudentScoresModalLabel">Upload Students Score For <strong class="ex-name"></strong> Examination </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('import.students.scores')}}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" class="exam-reg-id" name="exam_registration_id">
                <div class="modal-body">
                    <div>
                        <h6>Student Upload</h6>
                        <div><small>Select .xlsx file with students to register and upload students</small></div>
                        <div><small class="text-danger">Confirm the Examination details before uploading students</small></div>
                        <div class="row">
                            <div class="mb-3">
                                <input type="file" name="students_score_file" class="form-control form-control-file" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
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
