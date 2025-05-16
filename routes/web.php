<?php

use App\Http\Controllers\Admin\AcademicClassController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
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
Route::get('user/register/page',[AuthController::class,'registerUser'])->name('user.register.page');
Route::post('user/login',[AuthController::class,'login'])->name('login');
Route::post('user/register',[AuthController::class,'register'])->name('register');

Route::get('ajax/user/confirm/username',[AuthController::class,'ajax_confirm_username'])->name('ajax.confirm.username');
Route::get('ajax/user/confirm-phone', [AuthController::class, 'ajax_confirm_phone'])->name('ajax.confirm.phone');


Route::middleware("auth")->group(function() {
    Route::get('user/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',function (){return view('pages.shared.dashboard');})->name('home');

    //schools
    Route::get('schools/list', [AdminController::class, 'getSchools'])->name('schools.list');
    Route::post('schools/save', [AdminController::class, 'saveSchool'])->name('schools.save');

    //subject
    Route::get('subject/list', [SubjectController::class, 'subjectList'])->name('subject.list');
    Route::post('subject/save', [SubjectController::class, 'saveSubject'])->name('subject.save');
    Route::post('subject/delete', [SubjectController::class, 'deleteSubject'])->name('subject.delete');
    //subject-ajax
    Route::get('ajax/subject/list', [SubjectController::class, 'ajax_subjectList'])->name('ajax.subject.list');

    //class
    Route::get('class/list', [\App\Http\Controllers\Admin\AcademicClassController::class, 'classesList'])->name('class.list');
    Route::post('class/save', [\App\Http\Controllers\Admin\AcademicClassController::class, 'saveClasses'])->name('class.save');
    Route::post('class/delete', [AcademicClassController::class, 'deleteClass'])->name('class.delete');

    //academic years
    Route::get('class/list', [\App\Http\Controllers\Admin\AcademicClassController::class, 'classesList'])->name('class.list');
    Route::post('class/save', [\App\Http\Controllers\Admin\AcademicClassController::class, 'saveClasses'])->name('class.save');

    //general settings
    Route::get('general/settings',[AdminController::class,'generalSettings'])->name('general.settings');

    Route::prefix('academics')->group(function () {
        //Exam registration
        Route::get('examination/center', [\App\Http\Controllers\Admin\AcademicClassController::class, 'examRegistrationPage'])->name('examination.center');//Todo call it examination center
        Route::post('save/exam/registration', [\App\Http\Controllers\Admin\AcademicClassController::class, 'saveExamRegistration'])->name('save.exam.registration');
        // Exam
        Route::get('exam/list', [\App\Http\Controllers\Admin\AcademicClassController::class, 'examList'])->name('exam.list');
        Route::post('exam/save', [\App\Http\Controllers\Admin\AcademicClassController::class, 'saveExam'])->name('exam.save');

        // Exam subject (AJAX)
        Route::get('ajax/exam/subject/list', [\App\Http\Controllers\Admin\AcademicClassController::class, 'ajax_exam_subjectList'])->name('ajax.exam.subject.list');
        // exam registered students
        Route::get('view/students', [\App\Http\Controllers\Admin\AcademicClassController::class, 'viewExamRegisteredStudents'])->name('view.exam.registered.students');

        //examinaction
        Route::post('approve/uploaded/scores', [\App\Http\Controllers\Admin\AcademicClassController::class, 'approveUploadedScores'])->name('approve.uploaded.scores');
    });

    Route::prefix('excel')->group(function () {
        //download student template template
        Route::get('download-register-students-template', [ExportController::class, 'downloadRegisterStudentsTemplate'])->name('download.register.students.template');
        Route::post('students/import', [\App\Http\Controllers\ImportController::class, 'importStudents'])->name('students.import');
        // download excel with uploaded student
        Route::get('download-students-score-template', [ExportController::class, 'downloadStudentsScoreTemplate'])->name('download.students.score.template');
        Route::post('import/students/scores', [\App\Http\Controllers\ImportController::class, 'importStudentsScores'])->name('import.students.scores');

    });

    Route::prefix('reports')->group(function () {

    });
});
