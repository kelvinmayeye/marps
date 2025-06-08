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


