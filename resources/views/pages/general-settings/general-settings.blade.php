@extends('layouts.master')
@section('page_title')
    General Settings
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">General Settings</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="">Settings</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Page Header -->


    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
            <h4 class="mb-3">Settings</h4>
        </div>
        <div class="card-body p-0 py-3">
            <div class="row px-2">
                <div class="col-md-3">
                    <div>
                        <label class="form-check-label fs-24" for="flexCheckChecked">
                            Enable sms sending
                        </label>
                        <input class="form-check-input ms-3" type="checkbox" value="" id="flexCheckChecked" style="width: 30px;height: 30px;" {{ config('app.allow_send_text') ? 'checked' : '' }}>
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
