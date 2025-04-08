<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $this->hasMany(ExamSubjects::class,'exam_id');
    }
}
