@extends('layouts.master')
@section('page_title')
    {{Auth::user()->username??''}} Profile
@endsection

@section('content')
    <div class="d-md-flex d-block mt-3">

        <div class="flex-fill ps-0 border-0">
            <div class="d-md-flex">
                <div class="flex-fill">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Profile Details</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('users.save')}}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control user-name" name="name" value="{{Auth::user()->name??''}}" placeholder="eg.John Jackson RockHood"
                                                   required="">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Username <small class="text-danger">*</small></label>
                                            <input type="text" name="username" value="{{Auth::user()->username??''}}" class="form-control username" readonly="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Title</label>
                                        <select class="form-control user-title" name="title" required="">
                                            <option value="" selected="">--Select title--</option>
                                            <option value="Mr" {{Auth::user()->title === 'Mr' ? 'selected':''}}>Mr</option>
                                            <option value="Miss" {{Auth::user()->title === 'Miss' ? 'selected':''}}>Miss</option>
                                            <option value="Sir" {{Auth::user()->title === 'Sir' ? 'selected':''}}>Sir</option>
                                            <option value="Madam" {{Auth::user()->title === 'Madam' ? 'selected':''}}>Madam</option>
                                            <option value="Dr" {{Auth::user()->title === 'Dr' ? 'selected':''}}>Dr</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control user-email" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone number <small class="text-danger">*</small></label>
                                            <input type="text" name="phone_number" value="{{Auth::user()->phone_number}}" class="form-control user-phone-number" placeholder="eg.0785100190" pattern="^0\d{9}$" maxlength="10" title="Number must start 0 and max in length is 10" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Position</label>
                                            <select class="form-control user-school-position" name="school_position" required="">
                                                <option value="" selected="">--Select school position--</option>
                                                <option value="Head Teacher" {{Auth::user()->school_position === 'Head Teacher' ? 'selected':''}}>Head Teacher</option>
                                                <option value="Academics" {{Auth::user()->school_position === 'Academics' ? 'selected':''}}>Academics</option>
                                                <option value="Despline Master" {{Auth::user()->school_position === 'Despline Master' ? 'selected':''}}>Despline Master</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">School</label>
                                            <select class="form-control user-school-id" disabled title="User cant switch or changed school on he/her self">
                                                <option value="" selected>{{Auth::user()->school->name??'----'}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select class="form-control" disabled title="User cant switch or changed role on he/her self">
                                                <option value="" selected="">----</option>
                                                @foreach(\App\Models\Role::all() as $r)
                                                    <option value="{{$r->id}}" {{Auth::user()->role_id === $r->id ? 'selected':''}}>{{$r->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-block d-xl-flex d-flex justify-content-end">
                                        <button class="btn btn-primary" type="submit">
                                            save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{route('users.change.password')}}" method="post">
                                    @csrf
                                    <div class="col-md-5 mx-auto">
                                        <div class="mb-3 mb-3">
                                            <label class="form-label">Current Password</label>
                                            <div class="pass-group d-flex">
                                                <input type="password" name="current_password" class="pass-input form-control">
                                                <span class="ti toggle-password ti-eye-off"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 mb-3">
                                            <label class="form-label">New Password</label>
                                            <div class="pass-group d-flex">
                                                <input type="password" name="password" class="pass-input form-control">
                                                <span class="ti toggle-password ti-eye-off"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="pass-group d-flex">
                                                <input type="password" name="password_confirmation" class="pass-input form-control">
                                                <span class="ti toggle-password ti-eye-off"></span>
                                            </div>
                                        </div>
                                        <div class="d-block d-xl-flex d-flex justify-content-end">
                                            <button class="btn btn-danger" type="submit">
                                                change
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
    <script>

    </script>
@endsection
