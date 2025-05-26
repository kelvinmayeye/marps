<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicGrade extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'min_score' => 'float',
        'max_score' => 'float',
        'points' => 'float',
    ];
}
