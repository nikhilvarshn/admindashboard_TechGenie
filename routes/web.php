<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ActiveUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\TotalTicketController;
use App\Http\Controllers\ClosedTicketController;
use App\Http\Controllers\InactiveUserController;
use App\Http\Controllers\RaisedTicketController;
use App\Http\Controllers\InprogressTicketController;


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
    Route::get('/getRegistered', 'getRegistered');
});

Route::controller(ActiveUserController::class)->group(function (){
    Route::get('/activeuser', 'index');
});

Route::controller(InactiveUserController::class)->group(function (){
    Route::get('/inactiveuser', 'index');
    Route::get('/getdata','getdata');
});


Route::controller(MentorController::class)->group(function () {
    Route::get('/mentor', 'index');
    Route::post('/mentor', 'store');
    Route::get('/getMentorData', 'show'); 
    Route::get('/mentor/edit/{id}', 'edit');
    Route::get('/mentor/delete/{id}', 'destroy');
});

Route::controller(TotalTicketController::class)->group(function () {
    Route::get('/totaltickets', 'index');
});

Route::controller(RaisedTicketController::class)->group(function () {
    Route::get('/raisedtickets', 'index');
});

Route::controller(ClosedTicketController::class)->group(function () {
    Route::get('/closedtickets', 'index');
});

Route::controller(InprogressTicketController::class)->group(function () {
    Route::get('/inprogresstickets', 'index');
});

Route::controller(LoginController::class)->group(function (){
    Route::get('/login', 'index');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index');
    Route::post('/category', 'store');
    Route::get('/getCategoryData', 'show'); 
    Route::get('/category/edit/{id}', 'edit');
    Route::get('/category/delete/{id}', 'destroy');
});
