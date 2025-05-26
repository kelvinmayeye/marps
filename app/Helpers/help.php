<?php

function mydebug($array){
    echo '<pre>';
    print_r(isset($array)?$array:null);
    die();
}

function randomString($limit = 4, $with_numbers = true) {
    $characters = $with_numbers
        ? '0123456789'
        : '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $randomString = '';
    for ($i = 0; $i < $limit; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function authUserHasRole(){
    $userRole = Auth::user()->role_id;
    if (empty($user)) return false;
    return $userRole;
}

function rolesPermissionGrouped($roleId)
{
    return \App\Models\RolePermission::with('permission')
        ->where('role_id', $roleId)
        ->get()
        ->groupBy(fn($rp) => $rp->permission->group)
        ->map(fn($group) => $group->pluck('permission.name')->toArray())
        ->toArray();
}

if (!function_exists('hasPermission')) {
    function hasPermission($group, $permission)
    {
//        mydebug(Auth::user()->role->name);
        if (Auth::user()->role->name == 'admin'){
//            mydebug('admiuehre');
            return true;
        }

        $permissions = View::shared('groupedPermissions') ?? [];

        if (empty($permissions) && Auth::check() && Auth::user()->role) {
            $permissions = \App\Models\RolePermission::with('permission')
                ->where('role_id', Auth::user()->role->id)
                ->get()
                ->pluck('permission')
                ->filter()
                ->groupBy('group')
                ->map(fn($items) => $items->pluck('name')->toArray())
                ->toArray();
        }

        return isset($permissions[$group]) && in_array($permission, $permissions[$group]);
    }
}


