<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', [\App\Http\Controllers\AuthController::class , 'login']);
Route::post('register', [\App\Http\Controllers\AuthController::class , 'register']);

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('logout', [\App\Http\Controllers\AuthController::class , 'logout']);
    Route::post('refresh', [\App\Http\Controllers\AuthController::class , 'refresh']);
    Route::post('me', 'AuthController@me');


    ///
    Route::post('insertInterview', [\App\Http\Controllers\InterviewController::class , 'insertInterview']);
    Route::post('updateInterview', [\App\Http\Controllers\InterviewController::class , 'updateInterview']);
    Route::post('deleteInterview', [\App\Http\Controllers\InterviewController::class , 'deleteInterview']);
    Route::get('showInterview/{id}', [\App\Http\Controllers\InterviewController::class , 'showInterview']);
    Route::get('sendNotify', [\App\Http\Controllers\InterviewController::class , 'sendNotify']);
});





//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('test' , [\App\Http\Controllers\WeatherController::class , 'test']);
