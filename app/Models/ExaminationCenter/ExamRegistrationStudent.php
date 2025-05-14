<?php

namespace App\Models\ExaminationCenter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRegistrationStudent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getFullnameAttribute()
    {
        return trim("{$this->firstname} {$this->middlename} {$this->lastname}");
    }
}
