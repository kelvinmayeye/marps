<?php

namespace App\Models\Admin;

use App\Models\ExaminationCenter\ExamRegistration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function examRegistration(): HasMany
    {
        return $this->hasMany(ExamRegistration::class);
    }
}
