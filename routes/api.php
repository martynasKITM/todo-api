<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

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

Route::get('/all',[TodoController::class,'tasks']); // R
Route::post('/add-task',[TodoController::class,'addTask']); //C
Route::get('/task/delete/{id}',[TodoController::class,'delete']); //D
Route::post('/update-task/{id}',[TodoController::class,'update']); //U


//Auth
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']],function ()
{
    Route::post('logout',[AuthController::class,'logout']);
});
