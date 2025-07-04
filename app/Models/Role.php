<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function rolePermissions(): HasMany
    {
        return $this->hasMany(RolePermission::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
