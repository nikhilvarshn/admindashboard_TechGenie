<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\ActiveUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\Backend\MainController;
use App\Mail\MyMail;
// use Illuminate\Mail\Mailer;



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

// Route::get('/', [IndexController::class, 'index'])->name('home');


Route::controller(RegisteredController::class)->group(function (){
    Route::get('/registered', 'index');
    Route::get('/getRegistered', 'getRegistered');
});


// Route::controller(ActiveUserController::class)->group(function (){
//     Route::get('/activeuser', 'index');
// });

// Route::controller(InactiveUserController::class)->group(function (){
//     Route::get('/inactiveuser', 'index');
// });
// total_users


Route::middleware(['myauth'])->group(function(){

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

Route::get('/',[MainController::class,'index']);
Route::get('/totaluser',[MainController::class,'totaluser']);
Route::get('/activeuser',[MainController::class,'activeuser']);
Route::get('/inactiveuser',[MainController::class,'inactiveuser']);
Route::get('/transaction_history',[MainController::class,'transaction_history']);
Route::get('/plans',[MainController::class,'plans']);
Route::get('/totalticket',[MainController::class,'totalticket']);
Route::get('/raisedticket',[MainController::class,'raisedticket']);
Route::get('/processingticket',[MainController::class,'processingticket']);
Route::get('/closedticket',[MainController::class,'closedticket']);
Route::get('/createCategory',[MainController::class,'createCategory']);
Route::get('/totalmentors',[MainController::class,'totalmentor']);
Route::get('/logout',[MainController::class,'logout']);
Route::post('/',[MainController::class,'adminlogin']);
// Route::get('/mymail',function(){
//     // Mail::to('shivamtiwari.shivatiwari@gmail.com')->send(new MyMail());
    
//     return 'done';
// });

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
