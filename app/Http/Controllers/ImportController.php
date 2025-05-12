<?php

namespace App\Http\Controllers;

use App\Imports\Students\StudentsImport;
use App\Imports\Students\StudentsScoreImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

            $file_path = $students_score_file->storeAs($temp_import, time() . '.' . $extension);
            Excel::import(new StudentsScoreImport(exam_registration_id: $request->get('exam_registration_id')), $file_path);
            DB::commit();
            if (Storage::directoryExists($temp_import)) Storage::deleteDirectory($temp_import);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
        return redirect()->route('exam.subject.scores')->with('success', 'students score uploaded successfully');
    }
}
