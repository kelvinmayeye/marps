@extends('layouts.master')
@section('page_title')
    All Exams
@endsection
@section('content')
    <div class="d-md-flex d-block align-items-center justify-content-between border-bottom pb-3">
        <div class="my-auto mb-2">
            {{-- TODO: This page will serve the following purposes:
                        1. Allow schools to register for the exams they intend to participate in.
                        2. Enable selection of an exam and assignment of participating students, with optional approval (not a priority for now).
                        3. Provide downloadable Excel templates pre-filled with selected students.
                        4. Facilitate the upload of student scores using the provided templates.
                        5. Automatically compute and generate academic results for each registered school based on the submitted scores.
              --}}
            <h3 class="page-title mb-1">Examination Center</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Examination</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Examination center</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="pe-1 mb-2">
                <a href="" class="btn btn-outline-light bg-white btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                    <i class="ti ti-refresh"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-2 col-xl-3">
            <div class="pt-3 d-flex flex-column list-group mb-4">
                <a href="{{route('examination.center',['page'=>'registration'])}}" class="d-block rounded p-2 {{$page === 'registration' ? 'active':''}}">Exam Registration</a>
                <a href="{{route('examination.center',['page'=>'all-exam-registered'])}}" class="d-block rounded p-2 {{$page === 'all-exam-registered' ? 'active':''}}">Your Examinations</a>
                <a href="{{route('examination.center',['page'=>'view-exam-scores'])}}" class="d-block rounded p-2 {{$page === 'view-exam-scores' ? 'active':''}}">Examination Scores</a>
{{--                <a href="" class="d-block rounded p-2">Preferences</a>--}}
{{--                <a href="" class="d-block rounded p-2">Social Authentication</a>--}}
{{--                <a href="" class="d-block rounded p-2">Language</a>--}}
            </div>
        </div>
        <div class="col-xxl-10 col-xl-9">
            @if($page === 'registration')
                @include('pages.exams.exam-center.registration')
            @endif
                @if($page === 'all-exam-registered')
                    @include('pages.exams.exam-center.all-exam-registered')
                @endif

                @if($page === 'view-exam-scores')
                    @include('pages.exams.exam-center.view-exam-scores')
                @endif
        </div>
    </div>

    <script>
        function getExamSubject(obj) {
            let exam_id = $(obj).val() || '';
            let checkbox = '';
            let holder_checkbox = $('div.subject-holder');

            holder_checkbox.empty();
            if (exam_id.length < 1) return;

            $.get(`{{ route('ajax.exam.subject.list') }}`, {exam_id: exam_id}, (result) => {
                if (result.status === 'success') {
                    $.each(result.data, function (index, subject) {
                        checkbox = `<div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" name="subjects[${subject.id}]" type="checkbox" value="${subject.id}" id="subject${subject.id}">
                        <label class="form-check-label" for="subjects${subject.id}">${subject.name}</label>
                    </div>
                </div>`;
                        holder_checkbox.append(checkbox);
                    });
                } else {
                    showError(result.msg || 'An error occurred on getting exam subject');
                }
            });
        }
    </script>
@endsection

@section('extra-script')

@endsection
