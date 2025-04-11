<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeList()
    {
        return DB::table('subjects','s')
            ->join('users as u', 'u.id', '=', 's.created_by')
            ->leftJoin('exam_subjects as e_sub','s.id','=','e_sub.subject_id')
            ->select(['s.*','u.name as creator_name']);
    }
}
