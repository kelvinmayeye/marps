<div class="flex-fill border-start ps-3">
    <div class="d-flex align-items-center justify-content-between flex-wrap border-bottom pt-3 mb-3">
        <div class="mb-3">
            <h5>Examination Registration</h5>
            <p>Provide your school to register exam</p>
        </div>
    </div>
    <div class="d-md-flex d-block">
        <div class="flex-fill">
            <div class="card">
                <div class="card-header">
                    <h5>School Information</h5>
                    <span><small>(#auto filled basing on user account)</small></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label class="form-label">School name</label>
                            <input type="text" value="{{$userSchoolInfo->name}}" class="form-control" placeholder="Enter School Name" readonly>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label class="form-label">Registration Number</label>
                            <input type="text" value="{{$userSchoolInfo->registration_no}}" class="form-control" placeholder="Enter Registration Number" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label class="form-label">Physical Address</label>
                            <input type="text" value="{{$userSchoolInfo->physical_address}}" class="form-control" placeholder="Physical Address" readonly>
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label class="form-label">Postal Address</label>
                            <input type="text" value="{{$userSchoolInfo->postal_address}}" class="form-control" placeholder="Postal Address" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h5>Exam Registration</h5>
                </div>
                <div class="card-body">
                    <div class="fw-bold">Examination registered history</div>
                    <div class="border border-1 border-primary-subtle rounded-2">
                        <div class="card-body">
                            @foreach($examRegisteredhistory as $er)
                                <div class="notice-widget">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center overflow-hidden me-2 mb-2 mb-sm-0">
											<span class="bg-primary-transparent avatar avatar-md me-2 rounded-circle flex-shrink-0">
												<i class="ti ti-books fs-16"></i>
											</span>
                                            <div class="overflow-hidden">
                                                <h6 class="text-truncate mb-1">{{$er->exam->name}}</h6>
                                                <div>
                                                    <i class="ti ti-book me-2"></i>
                                                    Total subject : {{$er->subjects->count()}}</div>
                                                <div>
                                                    <i class="ti ti-calendar me-2"></i>
                                                    Added on : {{\Carbon\Carbon::parse($er->created_at)->format('d M Y')}}
                                                </div>
                                            </div>
                                        </div>
                                        <span class="badge bg-light text-dark">
                                                        <i class="ti ti-clck me-1"></i>{{ $er->created_at->diffForHumans() }}
                                                    </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{route('save.exam.registration')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Examination <small class="text-danger fw-bold">(select examination)</small></label><!-- add select 2 -->
                                <select name="examination_id" class="form-control" onchange="getExamSubject(this)">
                                    <option value="" selected>select examination</option>
                                    @foreach(\App\Models\Admin\Exam::where('is_active',1)->get() as $e)
                                        <option value="{{$e->id}}">{{$e->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-2 row subject-holder">

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end gap-3">
                                    <a href="" class="btn btn-warning" type="reset">clear</a>
                                    <button class="btn btn-primary" type="submit">save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
