<?php

namespace App\Http\Controllers;

use App\Imports\Students\StudentsImport;
use App\Imports\Students\StudentsScoreImport;
use App\Models\ExaminationCenter\ExamRegistration;
use App\Models\ExaminationCenter\ExamRegistrationStudent;
use App\Models\ExaminationCenter\ExamRegistrationSubject;
use App\Models\ExaminationCenter\ExamSubjectScore;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportController extends Controller
{
    public function importStudents(Request $request){
        $request->validate(['students_file' => 'required']);
        DB::beginTransaction();
        try {
            if(empty($request->get('exam_registration_id'))) throw new Exception("Exam registration Id is required");

            if (!$request->hasFile('students_file')) throw new Exception("Excel file not is required!");
            $students_file = $request->file('students_file');

            $temp_import = 'temp_import';
            $allowed_extension = ['xlsx'];
            $extension = $students_file->getClientOriginalExtension();

            if (!in_array($extension, $allowed_extension)) throw new \Exception("File Format not allowed on .xlsx is required");

            $file_path = $students_file->storeAs($temp_import, time() . '.' . $extension);
            Excel::import(new StudentsImport(exam_registration_id: $request->get('exam_registration_id')), $file_path);
            $examRegistered = ExamRegistration::query()->find($request->get('exam_registration_id'));
            $total_student = ExamRegistrationStudent::query()->where('exam_registration_id',$examRegistered->id)->count();
            //update total_students uploaded
            $examRegistered->update(['total_students'=>$total_student]);
            DB::commit();
            if (Storage::directoryExists($temp_import)) Storage::deleteDirectory($temp_import);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Students Uploaded successfully');
    }

    public function importStudentsScores(Request $request){
        $request->validate(['students_score_file' => 'required']);
        DB::beginTransaction();
        try {
            if(empty($request->get('exam_registration_id'))) throw new Exception("Exam registration Id is required");

            if (!$request->hasFile('students_score_file')) throw new Exception("Excel file not is required!");
            $students_score_file = $request->file('students_score_file');

            $temp_import = 'temp_import';
            $allowed_extension = ['xlsx'];
            $extension = $students_score_file->getClientOriginalExtension();
            if (!in_array($extension, $allowed_extension)) throw new \Exception("File Format not allowed on .xlsx is required");

            $spreadsheet = IOFactory::load($students_score_file->getPathname());
            $properties = $spreadsheet->getProperties();
            if($request->get('exam_registration_id') !== $properties->getCategory()){
                throw new \Exception("This excel doc doesnt belong to the selected exam registered");
            }
            $file_path = $students_score_file->storeAs($temp_import, time() . '.' . $extension);
            Excel::import(new StudentsScoreImport(exam_registration_id: $request->get('exam_registration_id')), $file_path);
            $examRegistered = ExamRegistration::query()->find($request->get('exam_registration_id'));
            //update scores uploaded
            $examRegistered->update(['student_scores_uploaded'=>1]);
            DB::commit();
            if (Storage::directoryExists($temp_import)) Storage::deleteDirectory($temp_import);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('examination.center',['page'=>'view-exam-scores','exam_registration_id'=>$request->get('exam_registration_id')])->with('success', 'students score uploaded successfully');
    }
}
