<?php

use App\Models\ExaminationCenter\ExamRegistration;
use App\Models\ExaminationCenter\ExamRegistrationStudent;
use App\Models\ExaminationCenter\ExamSubjectScore;

function mydebug($array){
    echo '<pre>';
    print_r(isset($array)?$array:null);
    die();
}

function randomString($limit = 4, $with_numbers = true) {
    $characters = $with_numbers
        ? '0123456789'
        : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';
    for ($i = 0; $i < $limit; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function authUserHasRole(){
    $userRole = Auth::user()->role_id;
    if (empty($user)) return false;
    return $userRole;
}

function rolesPermissionGrouped($roleId)
{
    return \App\Models\RolePermission::with('permission')
        ->where('role_id', $roleId)
        ->get()
        ->groupBy(fn($rp) => $rp->permission->group)
        ->map(fn($group) => $group->pluck('permission.name')->toArray())
        ->toArray();
}

if (!function_exists('hasPermission')) {
    function hasPermission($group, $permission)
    {
        if (Auth::user()->role->name == 'admin') return true;

        $permissions = View::shared('groupedPermissions') ?? [];

        if (empty($permissions) && Auth::check() && Auth::user()->role) {
            $permissions = \App\Models\RolePermission::with('permission')
                ->where('role_id', Auth::user()->role->id)
                ->get()
                ->pluck('permission')
                ->filter()
                ->groupBy('group')
                ->map(fn($items) => $items->pluck('name')->toArray())
                ->toArray();
        }

        return isset($permissions[$group]) && in_array($permission, $permissions[$group]);
    }
}


if (!function_exists('getExamScoresSummary')) {
    function getExamScoresSummary($exam_registration_id)
    {
        $exam_registration = ExamRegistration::find($exam_registration_id);
        if (empty($exam_registration_id) || !$exam_registration)   return ['error' => 'Invalid or missing examination registration ID'];

        $scores = ExamSubjectScore::where('exam_registration_id', $exam_registration_id)->get()->toArray();
//        mydebug($scores);
        if (count($scores) === 0)  return ['error' => 'This examination has no score records yet'];

        $subjects = collect($scores)->map(function ($item) {
            return [
                'subject_id' => $item['subject_id'],
                'subject_name' => $item['subject_name'],
            ];
        })->unique('subject_id')->values()->toArray();

        $grouped_scores = [];
        $gender_count = ['M' => 0, 'F' => 0];

        foreach ($scores as $score) {
            $student_id = $score['exam_registration_student_id'];
            $student = ExamRegistrationStudent::find($student_id);
            if (!$student) continue;

            $points = $score['points'] ?? 0;

            if (!isset($grouped_scores[$student_id])) {
                $grouped_scores[$student_id] = [
                    'student_prem_number' => $score['student_prem_number'],
                    'student_name' => $student->fullname,
                    'gender' => $student->gender,
                    'scores' => [],
                    'total_points' => 0,
                    'div' => null, // new
                ];

                if ($student->gender === 'M') $gender_count['M']++;
                elseif ($student->gender === 'F') $gender_count['F']++;
            }

            $grouped_scores[$student_id]['scores'][$score['subject_id']] = [
                'score' => $score['score'],
                'grade' => $score['grade'],
                'points' => $score['points'],
            ];

            $grouped_scores[$student_id]['total_points'] += $points;
        }

        foreach ($grouped_scores as $student_id => $data) {
            $grouped_scores[$student_id]['div'] = getDivisionFromPoints($data['total_points']);
        }

        return [
            'exam_registration' => $exam_registration,
            'scores' => $scores,
            'subjects' => $subjects,
            'grouped' => $grouped_scores,
            'summary' => [
                'total_students' => count($grouped_scores),
                'total_subjects' => count($subjects),
                'male' => $gender_count['M'],
                'female' => $gender_count['F'],
            ]
        ];
    }
}

function getDivisionFromPoints($totalPoints)
{
    if ($totalPoints >= 7 && $totalPoints <= 17) {
        return 'Division I';
    } elseif ($totalPoints >= 18 && $totalPoints <= 21) {
        return 'Division II';
    } elseif ($totalPoints >= 22 && $totalPoints <= 25) {
        return 'Division III';
    } elseif ($totalPoints >= 26 && $totalPoints <= 33) {
        return 'Division IV';
    } elseif ($totalPoints >= 34) {
        return 'Division 0 (Fail)';
    } else {
        return 'Invalid';
    }
}

function generateExamSummaryStats(array $examSummary)
{
    if (empty($examSummary['grouped']) || empty($examSummary['scores'])) {
        return [
            'academic_highlights' => [],
            'division_summary' => [],
        ];
    }

    $grouped = $examSummary['grouped'];
    $scores = $examSummary['scores'];
    $subjects = $examSummary['subjects'];

    // 1. Academic Highlights
    $topStudent = null;
    $bottomStudent = null;
    $subjectTotals = [];

    foreach ($grouped as $studentId => $data) {
        // Top Student (lowest points = best)
        if (!$topStudent || $data['total_points'] < $topStudent['total_points']) {
            $topStudent = [
                'name' => $data['student_name'],
                'total_points' => $data['total_points'],
            ];
        }

        // Bottom Student (highest points = worst)
        if (!$bottomStudent || $data['total_points'] > $bottomStudent['total_points']) {
            $bottomStudent = [
                'name' => $data['student_name'],
                'total_points' => $data['total_points'],
            ];
        }

        // Aggregate scores per subject
        foreach ($data['scores'] as $subject_id => $scoreInfo) {
            if (!isset($subjectTotals[$subject_id])) {
                $subjectTotals[$subject_id] = ['total_score' => 0, 'count' => 0, 'name' => ''];
            }

            $subjectTotals[$subject_id]['total_score'] += $scoreInfo['score'];
            $subjectTotals[$subject_id]['count']++;
        }
    }

    // Match subject names
    foreach ($subjects as $subject) {
        if (isset($subjectTotals[$subject['subject_id']])) {
            $subjectTotals[$subject['subject_id']]['name'] = $subject['subject_name'];
        }
    }

    // Best and Weakest Subjects (by average)
    $bestSubject = null;
    $weakestSubject = null;

    foreach ($subjectTotals as $subject_id => $data) {
        $avg = $data['count'] ? $data['total_score'] / $data['count'] : 0;

        if (!$bestSubject || $avg > $bestSubject['avg']) {
            $bestSubject = [
                'name' => $data['name'],
                'avg' => round($avg),
            ];
        }

        if (!$weakestSubject || $avg < $weakestSubject['avg']) {
            $weakestSubject = [
                'name' => $data['name'],
                'avg' => round($avg),
            ];
        }
    }

    // 2. Division Summary
    $divisionCounts = [];

    foreach ($grouped as $studentData) {
        $div = $studentData['div'];
        if (!isset($divisionCounts[$div])) {
            $divisionCounts[$div] = 0;
        }
        $divisionCounts[$div]++;
    }

    return [
        'academic_highlights' => [
            'top_student' => $topStudent,
            'bottom_student' => $bottomStudent,
            'best_subject' => $bestSubject,
            'weakest_subject' => $weakestSubject,
        ],
        'division_summary' => $divisionCounts,
    ];
}
