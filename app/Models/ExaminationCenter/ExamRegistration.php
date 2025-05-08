<?php

namespace App\Models\ExaminationCenter;

use App\Models\Admin\Exam;
use App\Models\Admin\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistration extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function exam(){
        return $this->belongsTo(Exam::class,'examination_id');
    }

    public function school(){
        return $this->belongsTo(School::class);
    }
}
