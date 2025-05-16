<?php

namespace App\Models\ExaminationCenter;

use App\Models\Admin\Exam;
use App\Models\Admin\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function subjects(){
        return $this->hasMany(ExamRegistrationSubject::class);
    }

    public function students(){
        return $this->hasMany(ExamRegistrationStudent::class);
    }

    public function createdby(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function approvedby(): BelongsTo
    {
        return $this->belongsTo(User::class,'approved_by');
    }
}
