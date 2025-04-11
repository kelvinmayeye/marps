<div class="modal fade" id="delete-object-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="modal-delete-form" action="" method="post">
                @csrf
                <input type="hidden" id="delete-object-id" name="object_id" value="">
                <div class="modal-body text-center">
							<span class="delete-icon p-2 text-danger" style="">
								<i class="ti ti-trash-x fs-2"></i>
							</span>
                    <h4>Confirm Deletion</h4>
                    <p>Are you sure you want to delete this record.</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
