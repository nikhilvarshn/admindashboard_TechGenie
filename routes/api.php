<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('buyplan',[APIController::class,'userdetails']);
Route::post('finduserdetails',[APIController::class,'finduserdetail']);
Route::post('checkdata',[APIController::class,'checkdata']);
Route::post('findplanstatus',[APIController::class,'findplanstatus']);
Route::post('raiseticket',[APIController::class,'raiseticket']);
Route::post('fetchticket',[APIController::class,'fetchTicket']);
Route::post('get_transaction',[APIController::class,'getTransaction']);
Route::post('createCategory',[APIController::class,'createCategory']);
Route::get('showCategoryData',[APIController::class,'showCategoryData']);
Route::get('deleteCategoryData/{id}',[APIController::class,'deleteCategoryData']);
Route::get('getcategory/{id}',[APIController::class,'getcategory']);
Route::post('editcategory',[APIController::class,'editcategory']);
Route::post('creatementor',[APIController::class,'createMentor']);
Route::get('getmentor/{id}',[APIController::class,'getMentor']);
Route::post('editmentor',[APIController::class,'editmentor']);
Route::get('deletementor/{id}',[APIController::class,'deletementor']);
