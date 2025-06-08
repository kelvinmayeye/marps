<?php

namespace App\Models\ExaminationCenter;

use App\Models\Admin\AcademicGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubjectScore extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['grade', 'points']; // These will be included in arrays and JSON automatically

    public function getGradeAttribute()
    {
        return $this->getAcademicGrade()?->grade;
    }

    public function getPointsAttribute()
    {
        return $this->getAcademicGrade()?->points;
    }

    protected function getAcademicGrade()
    {
        return AcademicGrade::where('min_score', '<=', $this->score)
            ->where('max_score', '>=', $this->score)
            ->first();
    }
}
