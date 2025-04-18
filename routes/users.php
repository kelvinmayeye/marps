<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth")->group(function() {
    Route::get('users/list', [UserController::class, 'getAllUsers'])->name('users.list');
    Route::post('users/save', [UserController::class, 'saveUser'])->name('users.save');


    Route::get('roles/list', [UserController::class, 'getAllRoles'])->name('roles.list');
    Route::post('roles/save', [UserController::class, 'saveRole'])->name('roles.save');


    Route::get('roles/permissions', [UserController::class, 'getAllPermissions'])->name('roles.permissions');
});
