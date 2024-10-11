<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CorsesController;
use App\Http\Controllers\Dashbord\DashbordController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeacherController;
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


Route::get('/loginHome', [AuthController::class, 'showLoginForm'])->name('login_home');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/', [DashbordController::class,'index'])->name('dashboard');
    Route::get('/FacultyHome', [CommonController::class,'facultyHome'])->name('faculty_home')->middleware('role:ADMIN');
    Route::get('/DepartmentHome', [CommonController::class,'departmentHome'])->name('department_home')->middleware('role:ADMIN');
    Route::get('/TeacherHome', [TeacherController::class,'home'])->name('teacher_home')->middleware('role:ADMIN');
    Route::post('/NewTeacher', [TeacherController::class,'store'])->name('new_teacher')->middleware('role:ADMIN');
    Route::post('/DeleteTeacher', [TeacherController::class,'delete'])->name('delete_teacher')->middleware('role:ADMIN');

    Route::get('/StudentHome', [StudentsController::class,'home'])->name('student_home')->middleware('role:ADMIN');
    Route::post('/NewStudent', [StudentsController::class,'store'])->name('new_student')->middleware('role:ADMIN');
    Route::post('/DeleteStudent', [StudentsController::class,'delete'])->name('delete_student')->middleware('role:ADMIN');

    Route::get('/ModuleHome', [ModulesController::class,'home'])->name('module_home')->middleware('role:ADMIN|ACADEMIC_HEAD|TEACHER|STUDENT');
    Route::post('/NewModule', [ModulesController::class,'store'])->name('new_modules')->middleware('role:ADMIN|ACADEMIC_HEAD');
    Route::post('/DeleteModule', [ModulesController::class,'deleteModule'])->name('delete_modules')->middleware('role:ADMIN|ACADEMIC_HEAD');

    Route::get('/CourseHome', [CorsesController::class,'home'])->name('course_home')->middleware('role:ADMIN|ACADEMIC_HEAD|TEACHER|STUDENT');
    Route::post('/NewCourse', [CorsesController::class,'store'])->name('new_course')->middleware('role:ADMIN|ACADEMIC_HEAD');
    Route::post('/DeleteCourse', [CorsesController::class,'delete'])->name('delete_course')->middleware('role:ADMIN|ACADEMIC_HEAD');
    

});
