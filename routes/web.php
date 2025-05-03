<?php

use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Schedule\ScheduleController;
use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Admin\Setting\SettingController as SettingSettingController;
use App\Http\Controllers\Admin\Student\StudentController;
use App\Http\Controllers\Admin\Subject\SubjectController;
use App\Http\Controllers\Admin\Teacher\TeacherController;
use App\Http\Controllers\Admin\Year\YearController;
use App\Http\Controllers\Guest\Password\PasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Student\Dashboard\DashboardController as StudentDashboardDashboardController;
use App\Http\Controllers\Student\Module\ModuleController as ModuleModuleController;
use App\Http\Controllers\Student\Module\ScheduleModuleController as ModuleScheduleModuleController;
use App\Http\Controllers\Student\ModuleScoreController as StudentModuleScoreController;
use App\Http\Controllers\Student\Schedule\ModuleController as StudentScheduleModuleController;
use App\Http\Controllers\Student\Schedule\ScheduleController as StudentScheduleScheduleController;
use App\Http\Controllers\Student\Setting\SettingController as StudentSettingSettingController;
use App\Http\Controllers\Teacher\Dashboard\DashboardController as DashboardDashboardController;
use App\Http\Controllers\Teacher\Module\ModuleController;
use App\Http\Controllers\Teacher\Module\ModuleScoreController;
use App\Http\Controllers\Teacher\Schedule\ModuleController as ScheduleModuleController;
use App\Http\Controllers\Teacher\Schedule\ScheduleController as ScheduleScheduleController;
use App\Http\Controllers\Teacher\Setting\SettingController;
use App\Http\Controllers\Teacher\Student\StudentController as StudentStudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest.index');
})->name('guest.index');

Auth::routes();

Route::prefix('guest')->name('guest.')->group(function () {
    Route::resources([
        'login'=>LoginController::class,
        'password'=>PasswordController::class,
    ]);
    Route::get('guest/login/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('login.logout');
});

Route::middleware(['PreventBackHistory','auth','isAdmin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resources([
        'dashboard'=>DashboardController::class,
        'course'=>CourseController::class,
        'subject'=>subjectController::class,
        'teacher'=>TeacherController::class,
        'student'=>StudentController::class,
        'year'=>YearController::class,
        'section'=>SectionController::class,
        'schedule'=>ScheduleController::class,
        'setting'=>SettingSettingController::class,
    ]);
});

Route::middleware(['auth','isTeacher'])->prefix('teacher')->name('teacher.')->group(function(){
    Route::resources([
        'dashboard'=>DashboardDashboardController::class,
        'schedule'=>ScheduleScheduleController::class,
        'module'=>ModuleController::class,
        'student'=>StudentStudentController::class,
        'module_score'=>ModuleScoreController::class,
        'schedule_module'=>ScheduleModuleController::class,
        'setting'=>SettingController::class,
    ]);
});

Route::middleware(['auth','isStudent'])->prefix('student')->name('student.')->group(function(){
    Route::resources([
        'dashboard'=>StudentDashboardDashboardController::class,
        'schedule'=>StudentScheduleScheduleController::class,
        'module'=>ModuleModuleController::class,
        'schedule_module'=>StudentScheduleModuleController::class,
        'module_score'=>StudentModuleScoreController::class,
        'setting'=>StudentSettingSettingController::class,
    ]);
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
