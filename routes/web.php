<?php

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
Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('reset.password');
Route::get('/user',function(){
    return view('dashboard');
});
Route::get('/user/{id}',[UserController::class,'profile'])->name('user.profile');;


// Route::get('/users', 'UserController@index')->name('users.index');
    // Route::get('/users/{id}', 'UserController@show')->name('users.show');

    // // Event routes
    // Route::get('/events', 'EventController@index')->name('events.index');
    // Route::get('/events/{id}', 'EventController@show')->name('events.show');

    // // Job Post routes
    // Route::get('/jobs', 'JobPostController@index')->name('jobs.index');
    // Route::get('/jobs/{id}', 'JobPostController@show')->name('jobs.show');
    // Route::post('/jobs', 'JobPostController@store')->name('jobs.store');
    // Route::put('/jobs/{id}', 'JobPostController@update')->name('jobs.update');
    // Route::delete('/jobs/{id}', 'JobPostController@destroy')->name('jobs.destroy');

    // // Job Applied routes
    // Route::get('/jobs/{id}/apply', 'JobAppliedController@apply')->name('jobs.apply');
    // Route::get('/jobs/{id}/applicants', 'JobAppliedController@applicants')->name('jobs.applicants');

    // // Chat routes
    // Route::get('/chat', 'ChatController@index')->name('chat.index');
    // Route::post('/chat', 'ChatController@store')->name('chat.store');
    // Route::get('/chat/{id}', 'ChatController@show')->name('chat.show');

    // // Follow routes
    // Route::post('/follow/{id}', 'FollowController@follow')->name('follow.follow');
    // Route::delete('/unfollow/{id}', 'FollowController@unfollow')->name('follow.unfollow');