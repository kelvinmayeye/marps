<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeList(){
        return DB::table('roles','r')
            ->leftJoin('role_permissions as rp','rp.role_id','=','r.id')
            ->leftJoin('permissions as p','rp.permission_id','=','p.id')
            ->select('r.id','r.name as role_name','p.id as permission_id','p.name as permission_name','p.group as permission_group');
    }
}
