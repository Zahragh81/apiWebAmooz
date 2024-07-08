<?php

use App\Http\Controllers\Api\V1\PostController as V1PostController;
use App\Http\Controllers\Api\V2\PostController as V2PostController;
//use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//کد براساس دوره
//Route::get('post', [PostController::class, 'index']);
//Route::get('post/{post}', [PostController::class, 'show']);
//Route::post('post', [PostController::class, 'store']);
//Route::put('post/{post}', [PostController::class, 'update']);
//Route::delete('post/{post}', [PostController::class, 'destroy']);


//ورژن بندی به صورت زیر
Route::prefix('v1')->group(function () {
    Route::prefix('/post')->controller(V1PostController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('store', 'store');
        Route::get('/show/{post}', 'show');
        Route::put('/update/{post}', 'update');
        Route::delete('destroy/{post}', 'destroy');
    });
});

Route::prefix('v2')->group(function () {
    Route::prefix('/post')->controller(V2PostController::class)->group(function () {
        Route::get('/', 'index')->middleware('auth:api');
        Route::post('store', 'store');
        Route::get('/show/{post}', 'show');
        Route::put('/update/{post}', 'update');
        Route::delete('destroy/{post}', 'destroy');
    });
});

//Route::prefix('/post')->controller(PostController::class)->group(function (){
//   Route::get('/', 'index');
//   Route::post('store', 'store');
//   Route::get('/show/{post}', 'show');
//   Route::put('/update/{post}', 'update');
//   Route::delete('destroy/{post}', 'destroy');
//});


Route::apiResource('user', UserController::class);


//پکیج سنکتون با توجه به دوره
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
