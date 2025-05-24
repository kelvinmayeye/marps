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

function rolesPermission($roleId)
{
    $permissions = \App\Models\RolePermission::with('permission')
        ->where('role_id', $roleId)
        ->get()
        ->map(function ($rolePermission) {
            return [
                'id' => $rolePermission->permission->id,
                'name' => $rolePermission->permission->name,
            ];
        })
        ->toArray();

    return $permissions;
}


