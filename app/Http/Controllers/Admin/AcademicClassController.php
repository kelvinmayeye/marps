<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AcademicClass;
use App\Models\Admin\Exam;
use App\Models\Admin\ExamSubject;
use App\Models\Admin\ExamType;
use App\Models\Admin\School;
use App\Models\Admin\Subject;
use App\Models\ExaminationCenter\ExamRegistration;
use App\Models\ExaminationCenter\ExamRegistrationStudent;
use App\Models\ExaminationCenter\ExamRegistrationSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AcademicClassController extends Controller
{
    public function classesList(Request $request){
        $classes = AcademicClass::with('creator')->get();
        return view('pages.classes.class-list',compact('classes'));
    }

    public function saveClasses(Request $request)
    {
//        mydebug($request->all());
        try {
            $classArray = $request->except('_token');
            $classArray['status'] = $classArray['status'] === 'on' ? 1 : 0;

            if (empty($classArray['class_id'])) {
                unset($classArray['class_id']);
                $classArray['created_by'] = \Auth::id();
                AcademicClass::create($classArray);
            } else {
                $ac_class = AcademicClass::findOrFail($classArray['class_id']);
                unset($classArray['class_id']);
                $ac_class->update($classArray);
            }

            return back()->with('success', 'Subject saved successfully');
        } catch (\Exception $e) {
            throw $e;
            return back()->with('error', $e->getMessage());
        }
    }

    public function deleteClass(Request $request){
        $classId = $request->get('object_id');

        try {
            $academicClass = AcademicClass::find($classId);
            if (!$academicClass)  return redirect()->back()->with('error', 'Class not found');
            $academicClass->delete();
            return redirect()->back()->with('success', 'Class Deleted Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function examRegistrationPage(Request $request){
        $page = $request->get('page');
        if (empty($page)) redirect()->route('user.home')->with('error','failed to get specified page');
        if(empty(Auth::user()->school_id))  return back()->with('error','Your account is not assigned to school');
        $userSchoolInfo = School::query()->find(Auth::user()->school_id);
        if(!$userSchoolInfo) return back('error','User school information not found');
        $examRegisteredhistory = ExamRegistration::query()->where('school_id',Auth::user()->school_id)->get();
//        mydebug($examRegisteredhistory);
        return view('pages.exams.exam-registration-page',compact('userSchoolInfo','examRegisteredhistory','page'));
    }

    public function saveExamRegistration(Request $request){
        try {
            DB::beginTransaction();
            $examination_id = $request->get('examination_id');
            $subjects = $request->get('subjects');
            $exam = Exam::find($examination_id);
            if (count($subjects) == 0) throw new \Exception("No subject selected");

            $existing = ExamRegistration::where('school_id', Auth::user()->school_id)
                ->where('examination_id', $examination_id)
                ->first();
            if ($existing) throw new \Exception("Examination registration already exists for this school");

            $exam_reg = ExamRegistration::query()->create([
                'school_id'=>Auth::user()->school_id,
                'examination_id'=>$examination_id,
                'created_by'=>Auth::user()->id,
            ]);
            foreach ($subjects as $s){
                ExamRegistrationSubject::create([
                    'exam_registration_id'=>$exam_reg->id,
                    'subject_id'=>$s,
                ]);
            }
            DB::commit();
            return redirect()->route('home')->with('success','Exam Registered Successful');
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());
        }
    }

    public function examList(Request $request){
        $exams = Exam::list()->get();
        $exams = $exams->unique('id')->values();
        $exams = $exams->map(function ($exam) {
            $exam->exam_subject_count = ExamSubject::where('exam_id', $exam->id)->count();
            return $exam;
        });
        $examTypes = ExamType::all();
//        mydebug($exams);
        return view('pages.exams.exam-list',compact('exams','examTypes'));
    }

    public function saveExam(Request $request)
    {
//        mydebug($request->all());
        try {
            $examArray = $request->except('_token','exam_subjects');
            $examSubjectsArray = $request->get('exam_subjects');
            $examArray['is_active'] = $examArray['is_active'] === 'on' ? 1 : 0;

            if (empty($examArray['exam_id'])) {
                unset($examArray['exam_id']);
                $examArray['created_by'] = \Auth::id();
                $ac_class = Exam::create($examArray);
            } else {
                $ac_class = Exam::findOrFail($examArray['exam_id']);
                unset($examArray['exam_id']);
                $ac_class->update($examArray);
            }
            //adding exam subjects
            ExamSubject::where('exam_id',$ac_class->id)->delete();
            if(!empty($examSubjectsArray)){
                foreach ($examSubjectsArray as $key=>$es){
                    ExamSubject::create([
                        'subject_id'=>$es,
                        'exam_id'=>$ac_class->id,
                    ]);
                }
            }

            return back()->with('success', 'Exam saved successfully');
        } catch (\Exception $e) {
            throw $e;
//            return back()->with('error', $e->getMessage());
        }
    }

    public function ajax_exam_subjectList(Request $request){
        $result['status'] = "success";
        $examId = $request->get('exam_id');

        try {
            // Fetch all subjects
            $examSubjects = Subject::list()->get();

            // If exam_id is not empty and valid, check which subjects are linked to it
            if (!empty($examId) && Exam::find($examId)) {
                $examSubjects = $examSubjects->map(function ($subject) use ($examId) {
                    $subject->checked = ExamSubject::where('subject_id', $subject->id)
                        ->where('exam_id', $examId)
                        ->exists() ? 1 : 0;
                    return $subject;
                });
            } else {
                // If exam_id is empty or invalid, mark all as unchecked
                $examSubjects = $examSubjects->map(function ($subject) {
                    $subject->checked = 0;
                    return $subject;
                });
            }
            //get rid of redundancy
            $examSubjects = collect($examSubjects)->unique('id')->values()->all();

            $result['data'] = $examSubjects;
        } catch (\Exception $e) {
            $result = ['status' => 'error', 'msg' => $e->getMessage()];
        }

        return response()->json($result);
    }

    public function viewExamRegisteredStudents(Request $request){
        if (empty($request->get('exam_registration_id'))) return back()->with('error','Exam Registration Id not found');
        $examRegistration = ExamRegistration::find($request->get('exam_registration_id'));
        if (!$examRegistration) return back()->with('error','Exam Registration not found');
        $students = ExamRegistrationStudent::where('exam_registration_id',$examRegistration->id)->get();
//        mydebug($students);
        return view('pages.exams.exam-center.students.exam-registered-students',compact('students','examRegistration'));
    }
}
