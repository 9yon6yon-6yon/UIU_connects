<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/login', [UserController::class, 'login'])->name('user-login');
Route::post('/login', [UserController::class, 'loginCheck']);
Route::get('/signup', [UserController::class, 'register'])->name('user-sign-up');
Route::post('/signup', [UserController::class, 'regUser']);
Route::get('/forget-password',[UserController::class,'forgetPageView'])->name('forget.password.form');
Route::post('/forget-password',[UserController::class,'sendResetLink'])->name('forget.password.link');
Route::get('/reset-password/{token}', [UserController::class, 'resetPassView'])->name('reset.password.view');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password');

Route::get('/user',[UserController::class,'allinfo'])->name('user.dashboard');
Route::get('/user/{id}',[UserController::class,'profile'])->name('user.profile');
Route::get('/create-post',function(){
    return view('post-job');
})->name('create-post');
Route::get('/posts',[PostsController::class,'index'])->name('user.posts');
Route::post('/posts',[PostsController::class,'store'])->name('user.post');
Route::get('/posts/view/{id}',[PostsController::class,'show'])->name('view.p.post');
Route::get('/posts/edit/{id}',[PostsController::class,'edit'])->name('edit.p.post');
Route::put('/posts/update/{id}',[PostsController::class,'update'])->name('update.p.post');
Route::delete('/posts/delete/{id}',[PostsController::class,'destroy'])->name('delete.p.post');
Route::post('/posts/{id}/upvote', [PostsController::class, 'upvote'])->name('posts.upvote');
Route::post('/posts/{id}/downvote', [PostsController::class, 'downvote'])->name('posts.downvote');

Route::get('/job',[JobsController::class,'store'])->name('jobs.store');
Route::get('/event',[EventsController::class,'store'])->name('events.store');
Route::get('/settings', function(){
    return view('settings');
})->name('user.settings');
Route::get('/settings/logout',[UserController::class,'logout'])->name('user.logout');
Route::get('/settings/offline/{id?}',[UserController::class,'logout'])->name('user.offline');
Route::get('/search',[UserController::class,'searchUsers'])->name('user.search');
Route::get('/profile/{id}',[UserController::class,'personalInfo'])->name('user.profile.all');

Route::get('/follow/{id}', [UserController::class,'follows'])->name('follow');
