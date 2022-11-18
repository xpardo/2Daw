<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LanguageController;

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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('mail/test', [MailController::class, 'test'])->middleware(['auth']);



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

/*Route::resource('files', FileController::class) ->middleware(['auth', 'role.any:1,2,3,4']); */

Route::resource('files', FileController::class)->middleware(['auth', 'permission:files']);

// --------------------------------------------------
//Crud Post / Coment / Like
// --------------------------------------------------

/*Route::resource('posts', PostController::class) ->middleware(['auth', 'role.any:1,2,3']) */;

Route::resource('posts', PostController::class)->middleware(['auth', 'permission:posts']);

/*Route::resource('comment', CommentController::class) ->middleware(['auth', 'role.any:1,2,3']) */;
Route::resource('comment', CommentController::class)->middleware(['auth', 'permission:comment']);

Route::post('/like-post/{id}',[PostController::class,'likePost'])->name('like.post');


// --------------------------------------------------
//Idiom
// --------------------------------------------------



Route::get('/language/{locale}', [LanguageController::class]);