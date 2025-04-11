<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExamSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function scopeList()
    {
        return DB::table('exam_subjects','es')
            ->join('users as u', 'u.id', '=', 'es.created_by')
            ->join('subjects as s','s.id','=','es.subject_id')
            ->join('exams as e','e.id','=','es.exam_id')
            ->select(['es.*','u.name as creator_name']);
    }
}
