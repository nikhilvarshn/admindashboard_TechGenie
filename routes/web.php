<?php

use App\Http\Controllers\ActiveUserController;
use App\Http\Controllers\InactiveUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\Backend\MainController;

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
    Route::get('/getRegisteredData', 'show');
});


// Route::controller(ActiveUserController::class)->group(function (){
//     Route::get('/activeuser', 'index');
// });

// Route::controller(InactiveUserController::class)->group(function (){
//     Route::get('/inactiveuser', 'index');
// });
Route::get('/total_users',[MainController::class,'totaluser']);
Route::get('/activeuser',[MainController::class,'activeuser']);
Route::get('/inactiveuser',[MainController::class,'inactiveuser']);
Route::get('/transaction_history',[MainController::class,'transaction_history']);
Route::get('/plans',[MainController::class,'plans']);
Route::get('/totalticket',[MainController::class,'totalticket']);
Route::get('/raisedticket',[MainController::class,'raisedticket']);
Route::get('/processingticket',[MainController::class,'processingticket']);
Route::get('/closedticket',[MainController::class,'closedticket']);
Route::get('/createCategory',[MainController::class,'createCategory']);













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