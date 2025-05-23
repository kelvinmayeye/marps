<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth")->group(function() {
    Route::get('users/list', [UserController::class, 'getAllUsers'])->name('users.list');
    Route::get('users/requests', [UserController::class, 'getUsersRequests'])->name('users.account.requests');
    Route::post('users/accept/account/requests', [UserController::class, 'acceptAccountRequest'])->name('users.accept.account.request');
    Route::post('users/save', [UserController::class, 'saveUser'])->name('users.save');


    Route::get('roles/list', [UserController::class, 'getAllRoles'])->name('roles.list');
    Route::post('roles/save', [UserController::class, 'saveRole'])->name('roles.save');


    Route::get('roles/permissions', [UserController::class, 'getAllPermissions'])->name('roles.permissions');
    Route::post('roles/permissions', [UserController::class, 'saveRolePermission'])->name('save.role.permission');
});
