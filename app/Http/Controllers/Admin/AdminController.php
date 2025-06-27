<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AcademicGrade;
use App\Models\Admin\School;
use Illuminate\Http\Request;
use Mockery\Exception;

class AdminController extends Controller
{
    public function academicYears(Request $request){

        return view();
    }

    public function getSchools(Request $request){
        $schools = School::all();
        return view('pages.schools.schools-list',compact('schools'));
    }

    public function saveSchool(Request $request){
        try {
            $schoolArray = $request->except('_token');
            $schoolArray['is_active'] = $schoolArray['is_active'] === 'on' ? 1 : 0;

            // Check if code is unique during insertion and updating
            $registrationNo = $schoolArray['registration_no'];
            $schoolId = $schoolArray['school_id'] ?? null;

            $existingSchool = School::where('registration_no', $registrationNo);

            if ($schoolId)  $existingSchool = $existingSchool->where('id', '!=', $schoolId);


            $existingSchool = $existingSchool->first();

            if ($existingSchool) {
                return redirect()->back()->with('error', 'School registration no already exists');
            }

            if (empty($schoolArray['school_id'])) {
                unset($schoolArray['school_id']);
                $schoolArray['created_by'] = \Auth::id();
                School::create($schoolArray);
            } else {
                $subject = School::findOrFail($schoolArray['school_id']);
                unset($schoolArray['school_id']);
                $subject->update($schoolArray);
            }
            toastr()->success('School saved successfully');
            return redirect()->route('schools.list');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function generalSettings(Request $request){
        return view('pages.general-settings.general-settings');
    }

    public function getGrade(){
        $grades = AcademicGrade::all();

        return view('pages.academics.academics-grade-list',compact('grades'));
    }

    public function saveGrades(Request $request)
    {
        try {
            $gradeArray = $request->except('_token');
            $gradeId = $gradeArray['grade_id'] ?? null;
            $gradeName = $gradeArray['grade'];
            $min = $gradeArray['min_score'];
            $max = $gradeArray['max_score'];

            // Check if grade already exists (excluding current one if editing)
            $existingGrade = AcademicGrade::where('grade', $gradeName);
            if ($gradeId) {
                $existingGrade = $existingGrade->where('id', '!=', $gradeId);
            }

            if ($existingGrade->exists()) {
                return redirect()->back()->with('error', 'Grade already exists');
            }

            // Check for overlapping score range with other records
            $overlappingGrade = AcademicGrade::where(function ($query) use ($min, $max) {
                $query->whereBetween('min_score', [$min, $max])
                    ->orWhereBetween('max_score', [$min, $max])
                    ->orWhere(function ($query2) use ($min, $max) {
                        $query2->where('min_score', '<=', $min)
                            ->where('max_score', '>=', $max);
                    });
            });

            if ($gradeId) {
                $overlappingGrade = $overlappingGrade->where('id', '!=', $gradeId);
            }

            if ($overlappingGrade->exists()) {
                return redirect()->back()->with('error', 'The score range overlaps with another grade.');
            }

            unset($gradeArray['grade_id']);

            if (empty($gradeId)) {
                AcademicGrade::create($gradeArray);
            } else {
                $grade = AcademicGrade::findOrFail($gradeId);
                $grade->update($gradeArray);
            }

            toastr()->success('AcademicGrade saved successfully');
            return back();
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

}
