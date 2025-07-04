<?php

namespace App\Models\Admin;

use App\Models\ExaminationCenter\ExamRegistration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(ExamSubject::class,'exam_id');
    }

    public function schoolRegistration(): HasMany
    {
        return $this->hasMany(ExamRegistration::class,'examination_id');
    }

    public function scopeList()
    {
        return DB::table('exams','e')
            ->join('exam_types as ety','ety.id','=','e.exam_type_id')
            ->join('users as u', 'u.id', '=', 'e.created_by')
            ->leftJoin('exam_subjects as e_sub','e.id','=','e_sub.exam_id')
            ->leftJoin('subjects as s','s.id','=','e_sub.subject_id')
            ->select(['e.*','u.name as creator_name','ety.name as exam_type_name','s.id as subject_id','s.name as subject_name']);
    }

    public function scopeSummary()
    {
        return DB::table('exams as e')
            ->join('exam_types as ety','ety.id','=','e.exam_type_id')
            ->join('users as u', 'u.id', '=', 'e.created_by')
            ->leftJoin('exam_subjects as e_sub','e.id','=','e_sub.exam_id')
            ->leftJoin('subjects as s','s.id','=','e_sub.subject_id')

            ->select([
                'e.*',
                'u.name as creator_name',
                'ety.name as exam_type_name',
                's.id as subject_id',
                's.name as subject_name',

                // add sub-select for total_registered_subjects
                DB::raw('(SELECT COUNT(DISTINCT ers.subject_id)
                      FROM exam_registrations er
                      JOIN exam_registration_subjects ers ON ers.exam_registration_id = er.id
                      WHERE er.examination_id = e.id) as total_registered_subjects'),

                // add sub-select for total_schools_registered
                DB::raw('(SELECT COUNT(DISTINCT er.school_id)
                      FROM exam_registrations er
                      WHERE er.examination_id = e.id) as total_schools_registered')
            ]);
    }


}
