<?php

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

Route::get('/posts',[PostsController::class,'index'])->name('user.posts');
Route::post('/posts',[PostsController::class,'store']);
Route::get('/posts/view/{id}',[PostsController::class,'show']);
Route::get('/posts/edit/{id}',[PostsController::class,'edit']);
Route::put('/posts/update/{id}',[PostsController::class,'update']);
Route::delete('/posts/delete/{id}',[PostsController::class,'destroy']);

Route::post('/posts/{id}/upvote', [PostsController::class, 'upvote'])->name('posts.upvote');
Route::post('/posts/{id}/downvote', [PostsController::class, 'downvote'])->name('posts.downvote');


Route::get('/settings', function(){
    return view('settings');
})->name('user.settings');
Route::get('/settings/logout',[UserController::class,'logout'])->name('user.logout');
Route::get('/settings/offline/{id?}',[UserController::class,'logout'])->name('user.offline');
Route::get('/search/{key?}',[UserController::class,'searchUsers'])->name('user.search');
Route::get('/profile/{id}',[UserController::class,'personalInfo'])->name('user.profile.all');
// Route::post('/follow/{id}', 'FollowController@follow')->name('follow.follow');
// Route::delete('/unfollow/{id}', 'FollowController@unfollow')->name('follow.unfollow');