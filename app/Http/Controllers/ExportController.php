<?php

namespace App\Http\Controllers;

use App\Exports\ExamRegisteredStudentsExport;
use App\Models\Admin\Subject;
use App\Models\ExaminationCenter\ExamRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
//use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function downloadRegisterStudentsTemplate(){
        try {
            $templates_path = '..' . DIRECTORY_SEPARATOR . 'excel_templates' . DIRECTORY_SEPARATOR . 'register_students_template.xlsx';
            if (file_exists($templates_path)) {
                if(empty(Auth::user()->school->name)) throw new \Exception("Failed to download template, user not assigned to school");
                return Response::download($templates_path, Auth::user()->school->name.' students template.xlsx');
            } else {
                return redirect()->back()->with('error', 'Template file not found!');
            }
        }catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    public function downloadStudentsScoreTemplate(Request $request){
        try {
            $examRegistered = ExamRegistration::query()->find($request->get('exam_reg_id'));
            if (!$examRegistered) throw new \Exception("Exam Registered Reference ID not found");
            //get all exam subjects
            $examSubjects = $examRegistered->subjects->toArray();
            //add subject name to each item from subjects table using item subject_id
            if(count($examSubjects) == 0) throw new \Exception("This Exam has no Subject, please contact Admin");
            $examSubjects = array_map(function ($item) {
                $subject = Subject::query()->find($item['subject_id']);
                $item['subject_name'] = $subject ? $subject->name : null;
                return $item;
            }, $examSubjects);
            $subjectNames = array_column($examSubjects, 'subject_name');
            return Excel::download(new ExamRegisteredStudentsExport($examRegistered->id,$subjectNames),"Students Score template.xlsx");

        }catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }
}
