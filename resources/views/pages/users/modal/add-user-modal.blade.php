<div class="modal fade" id="add_user">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{route('users.save')}}" method="post">
                @csrf
                <input type="hidden" class="user-id" name="user_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Name <small class="text-danger">*</small></label>
                                <input type="text" class="form-control user-name" name="name" placeholder="eg.John Jackson RockHood" oninput="autoFillUsername(this)">
                                <span><small class="text-info fw-bold">Username will be automatically generated based on the first name entered in the name field</small></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <select class="form-control user-title" name="title">
                                    <option value="" selected>--Select title--</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Sir">Sir</option>
                                    <option value="Madam">Madam</option>
                                    <option value="Dr">Dr</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Username <small class="text-danger">*</small></label>
                                <input type="text" name="username" class="form-control username" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control user-email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Phone number <small class="text-danger">*</small></label>
                                <input type="text" name="phone_number" class="form-control user-phone-number" placeholder="eg.0785100190" pattern="^0\d{9}$" maxlength="10" title="Number must start 0 and max in length is 10" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">School <small class="text-danger">*</small></label>
                                <select class="form-control user-school-id" name="school_id" required>
                                    <option value="" selected>--Select School--</option>
                                    @foreach($schools??[] as $s)
                                        <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Position</label>
                                <select class="form-control user-school-position" name="school_position">
                                    <option value="" selected>--Select school position--</option>
                                    <option value="Head Teacher">Head Teacher</option>
                                    <option value="Academics">Academics</option>
                                    <option value="Decline">Decline</option>
                                </select>
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
