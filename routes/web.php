<?php

use App\Http\Controllers\Admin\AcademicClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class,'index'])->name('user.home');
Route::post('user/login',[AuthController::class,'login'])->name('login');

Route::middleware("auth")->group(function() {
    Route::get('user/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',function (){return view('pages.shared.dashboard');})->name('home');

    //subject
    Route::get('subject/list', [SubjectController::class, 'subjectList'])->name('subject.list');
    Route::post('subject/save', [SubjectController::class, 'saveSubject'])->name('subject.save');
    Route::post('subject/delete', [SubjectController::class, 'deleteSubject'])->name('subject.delete');

    //class
    Route::get('class/list', [\App\Http\Controllers\Admin\AcademicClassController::class, 'classesList'])->name('class.list');
    Route::post('class/save', [\App\Http\Controllers\Admin\AcademicClassController::class, 'saveClasses'])->name('class.save');
    Route::post('class/delete', [AcademicClassController::class, 'deleteClass'])->name('class.delete');

    //academic years
    Route::get('class/list', [\App\Http\Controllers\Admin\AcademicClassController::class, 'classesList'])->name('class.list');
    Route::post('class/save', [\App\Http\Controllers\Admin\AcademicClassController::class, 'saveClasses'])->name('class.save');
});
