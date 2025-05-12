<?php

namespace App\Imports\Students;

use App\Models\ExaminationCenter\ExamSubjectScore;
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
     * @throws ValidationException
    */
    public function model(array $row)
    {
        //Todo: get exam id,
        //Todo: get subject id from subject name from the excel
        mydebug($row);
        return new ExamSubjectScore();
    }
}
