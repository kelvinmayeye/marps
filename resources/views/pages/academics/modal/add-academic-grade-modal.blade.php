<div class="modal fade" id="add_grade">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Academic Grade</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('grade.save') }}" method="post">
                @csrf
                <input type="hidden" class="grade-id" name="grade_id" value=""> {{-- for future editing --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Grade <small class="text-danger">*</small></label>
                                <input type="text" class="form-control grade-name" name="grade" placeholder="e.g. A, B+" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Min Score <small class="text-danger">*</small></label>
                                <input type="number" step="0.01" class="form-control grade-min-score" name="min_score" placeholder="e.g. 80.00" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Max Score <small class="text-danger">*</small></label>
                                <input type="number" step="0.01" class="form-control grade-max-score" name="max_score" placeholder="e.g. 100.00" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Points</label>
                                <input type="number" step="0.01" class="form-control grade-points" name="points" placeholder="e.g. 4.00">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Remarks</label>
                                <input type="text" class="form-control grade-remarks" name="remarks" placeholder="e.g. Excellent, Good">
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
