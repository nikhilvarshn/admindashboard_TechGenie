<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RegisteredController;

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

Route::get('/', [IndexController::class, 'index'])->name('home');


Route::controller(RegisteredController::class)->group(function (){
    Route::get('/registered', 'index');
});














// Route::get('/qualification', [QualificationController::class, 'index'])->name('home');

Route::controller(QualificationController::class)->group(function () {
    Route::get('/qualification', 'index');
    Route::post('/qualification', 'store');
    Route::get('/getQualificationData', 'show'); 
    Route::get('/qualification/edit/{id}', 'edit');
    Route::get('/qualification/delete/{id}', 'destroy');
});

Route::controller(StudentController::class)->group(function () {
    Route::get('/student', 'index');
    Route::post('/student', 'store');
    Route::get('/getStudentData', 'show'); 
    Route::get('/student/edit/{id}', 'edit');
    Route::get('/student/delete/{id}', 'destroy');
});