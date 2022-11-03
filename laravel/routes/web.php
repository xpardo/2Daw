<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
 });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
// ...
Route::get('mail/test', [MailController::class, 'test'])->middleware(['auth']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// --------------------------------------------------
//Email
// --------------------------------------------------

Route::get('mail/test', [MailController::class, 'test']);
// or
// Route::get('mail/test', 'App\Http\Controllers\MailController@test');


Auth::routes();




// --------------------------------------------------
//Crud File
// --------------------------------------------------


/*  Route::resource('files', FileController::class); */

Route::resource('files', FileController::class)->middleware(['auth', 'role.any:1,2,3,4']);

// --------------------------------------------------
//Crud Post / Coment
// --------------------------------------------------

Route::resource('posts', PostController::class);
Route::get('/post-list',[PostController::class,'postList'])->name('post.list');
Route::post('/like-post/{id}',[PostController::class,'likePost'])->name('like.post');
Route::post('/unlike-post/{id}',[PostController::class,'unlikePost'])->name('unlike.post');
Route::resource('coment', CommentController::class);