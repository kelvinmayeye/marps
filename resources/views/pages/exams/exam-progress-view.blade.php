@extends('layouts.master')

@section('page_title')
    Examination progress view
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">Examination Progress Overview</h3>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Academic</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Examination</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Examination progress</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Overall Exam Summary -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Total Students Participated</h5>
                <p class="mb-0"><strong>--</strong></p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Total Schools Participated</h5>
                <p class="mb-0"><strong>--</strong></p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Total Subjects</h5>
                <p class="mb-0"><strong>--</strong></p>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Total Divisions</h5>
                <p class="mb-0"><strong>--</strong></p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Grades Distribution by Subject</h5>
                <div id="gradesBySubjectChart"></div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Grades by School</h5>
                <canvas id="gradesBySchoolChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- School-wise Summary -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>School Performance</h4>
        </div>
        <div class="card-body">
            <p><strong>Best School:</strong> --</p>
            <p><strong>Last School:</strong> --</p>
            <p><strong>School-wise Positions:</strong></p>
            <ul>
                <li>1. --</li>
                <li>2. --</li>
                <li>3. --</li>
            </ul>
            <p><strong>Total Grades Awarded per School:</strong></p>
            <ul>
                <li>School A: -- grades</li>
                <li>School B: -- grades</li>
            </ul>
        </div>
    </div>

    <!-- Student-wise Summary -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Student Highlights</h4>
        </div>
        <div class="card-body">
            <p><strong>Best Student:</strong> --</p>
            <p><strong>Last Student:</strong> --</p>
            <p><strong>Total Grades Awarded:</strong> --</p>
        </div>
    </div>

    <!-- Subject-wise Summary -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Subject Performance</h4>
        </div>
        <div class="card-body">
            <p><strong>Best Subject:</strong> --</p>
            <p><strong>Grades Distribution per Subject:</strong></p>
            <ul>
                <li>Mathematics: -- grades</li>
                <li>English: -- grades</li>
            </ul>
        </div>
    </div>

    <!-- Additional Widgets -->
    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Average Scores Per School</h5>
                <p>--</p>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm p-3">
                <h5>Average Scores Per Subject</h5>
                <p>--</p>
            </div>
        </div>
    </div>

@endsection

@section('extra-script')
    <script>
        labels: @json($schoolNames??''),
        data: @json($schoolGrades??'')

        var options = {
            chart: {
                type: 'donut',
                height: 300
            },
            series: [44, 55, 13, 33], // mock data
            labels: ['Math', 'English', 'Physics', 'History'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: { width: 200 },
                    legend: { position: 'bottom' }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#gradesBySubjectChart"), options);
        chart.render();


        var ctx = document.getElementById('gradesBySchoolChart').getContext('2d');
        var gradesBySchoolChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['School A', 'School B', 'School C'],
                datasets: [{
                    label: 'Total Grades',
                    data: [120, 90, 60],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection
