<?php

namespace App\Imports\Students;

use App\Models\Admin\Exam;
use App\Models\Admin\Subject;
use App\Models\ExaminationCenter\ExamRegistration;
use App\Models\ExaminationCenter\ExamRegistrationStudent;
use App\Models\ExaminationCenter\ExamSubjectScore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsScoreImport implements ToModel, WithHeadingRow
{
    public function __construct(public $exam_registration_id)
    {
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws \Exception
     */
    public function model(array $row)
    {
        if(empty($row['prem_number'])) return null;;
        $examRegistration = ExamRegistration::find($this->exam_registration_id);
        if (!$examRegistration) {
            throw new \Exception("Registered Exam Reference not found");
        }
        if($row['exam_registered_id'] != $this->exam_registration_id){
            throw new \Exception("Student with PREM number ".$row['prem_number']."  exam registration ID doesn't match selected exam registered");
        }
        if(!empty($examRegistration->approved_by)){
            throw new \Exception("Scores for this exam registration have already been approved and cannot be updated or added");
        }

        $exam = Exam::find($examRegistration->examination_id);
        if (!$exam) {
            throw new \Exception("Exam Reference not found");
        }

        $premNumber = $row['prem_number'] ?? null;
        if (!$premNumber) {
            throw new \Exception("PREM number is missing in one of the rows");
        }

        $student = ExamRegistrationStudent::where([
            ['exam_registration_id', $this->exam_registration_id],
            ['prem_number', $premNumber]
        ])->first();

        if (!$student) {
            throw new \Exception("Student with PREM number {$premNumber} is not registered for this exam");
        }

        // Exclude non-subject fields
        $excluded = ['exam_registered_id', 'prem_number', 'firstname', 'middlename', 'lastname','gender'];
        $subjects = array_diff_key($row, array_flip($excluded));

        foreach ($subjects as $subjectName => $score) {
            if($score <= 0) $score = 0;
            if (!is_numeric($score))  throw new \Exception("Invalid score $score from student Excel with prem number $premNumber");
            $subjectName = str_replace('_', ' ', $subjectName);
            $subject = Subject::whereRaw('LOWER(name) = ?', [strtolower($subjectName)])->first();
            if ($subject) {
                ExamSubjectScore::updateOrCreate(
                    [
                        'exam_registration_student_id' => $student->id,
                        'subject_id' => $subject->id,
                    ],
                    [
                        'student_prem_number' => $premNumber,
                        'exam_registration_id' => $this->exam_registration_id,
                        'exam_id' => $exam->id,
                        'exam_name' => $exam->name,
                        'subject_name' => $subject->name,
                        'score' => $score,
                        'created_by' => Auth::id(),
                    ]
                );
            }else{
                throw new \Exception("Failed to get subject $subjectName");
            }
        }

        return null; // No need to return a model here
    }
}
