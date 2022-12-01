<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\LanguageController;

use App\Models\Role as R;
use App\Models\Permission as P;

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


// ...
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('mail/test', [MailController::class, 'test'])->middleware(['auth']);

require __DIR__.'/auth.php';

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




/* 
Route::resource('files', FileController::class); 


*/Route::resource('files', FileController::class)
    ->middleware(['auth', 'permission:files']);

// --------------------------------------------------
//Crud Post / Coment
// --------------------------------------------------

Route::resource('posts', PostController::class);

/* Route::resource('posts', PostController::class);


    */

Route::resource('posts', PostController::class)
    ->middleware(['auth', 'permission:'.P::POSTS]);
Route::resource('comment', CommentController::class)->middleware(['auth', 'permission:comment']);



// --------------------------------------------------
//Likes
// --------------------------------------------------


Route::controller(PostController::class)->group(function () {
    Route::post('/posts/{post}/likes', 'like')
        ->middleware(['auth','role:author'])
        ->name('posts.like');
    Route::delete('/posts/{post}/likes', 'unlike')
        ->middleware(['auth','role:author'])
        ->name('posts.unlike');
});


// --------------------------------------------------
//Idiom
// --------------------------------------------------



Route::get('/language/{locale}', [LanguageController::class, 'language']);

