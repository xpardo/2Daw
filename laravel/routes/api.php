<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PostController;

/*******************
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
* Token *
******************/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [TokenController::class, 'register']);

Route::post('/login', [TokenController::class, 'login']);

Route::post('/logout', [TokenController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', [TokenController::class, 'user'])->middleware('auth:sanctum');



/*****************
* Api File *
******************/

Route::apiResource('files', FileController::class);
Route::post('files/{file}', [FileController::class, 'update_workaround']);

/*****************
* Api Post / Like*
******************/
Route::apiResource('posts', PostController::class);
Route::post('/store', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::post('files/{file}', [PostController::class, 'update_workaround']);
Route::controller(PostController::class)->group(function () {
    Route::post('posts/{post}/likes','like',)
    ->middleware('auth:sanctum')
    ->name('posts.like');
    Route::post('posts/{post}/likes','unlike',)
    ->middleware('auth:sanctum')
    ->name('posts.unlike');
});
