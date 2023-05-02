<?php

use App\Http\Controllers\ChatController;
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
//user functionality 
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
//post routes for general posts
Route::get('/posts',[PostsController::class,'index'])->name('user.posts');
Route::post('/posts',[PostsController::class,'store'])->name('user.post');
Route::get('/posts/view/{id}',[PostsController::class,'show'])->name('view.p.post');
Route::post('/posts/view/{id}',[PostsController::class,'comment'])->name('add.comment');//comment function
Route::get('/posts/edit/{id}',[PostsController::class,'edit'])->name('edit.p.post');
Route::put('/posts/update/{id}',[PostsController::class,'update'])->name('update.p.post');
Route::delete('/posts/delete/{id}',[PostsController::class,'destroy'])->name('delete.p.post');
Route::get('/posts/{id}/upvote', [PostsController::class, 'upvote'])->name('posts.upvote');
Route::get('/posts/{id}/downvote', [PostsController::class, 'downvote'])->name('posts.downvote');
//post routes for job posts
Route::get('/job',[JobsController::class,'index'])->name('jobs.view');
Route::post('/job',[JobsController::class,'store'])->name('jobs.store');
Route::get('/job/view/{id}',[JobsController::class,'show'])->name('view.p.job');
Route::post('/job/view/{id}',[JobsController::class,'applyforjob'])->name('apply.job');
Route::get('/job/edit/{id}',[JobsController::class,'edit'])->name('edit.p.job');
Route::put('/job/update/{id}',[JobsController::class,'update'])->name('update.p.job');
Route::delete('/job/delete/{id}',[JobsController::class,'destroy'])->name('delete.p.job');
//post routes for event posts
Route::get('/event',[EventsController::class,'index'])->name('events.view');
Route::post('/event',[EventsController::class,'store'])->name('events.store');
Route::get('/event/view/{id}',[EventsController::class,'show'])->name('view.p.event');
Route::get('/event/edit/{id}',[EventsController::class,'edit'])->name('edit.p.event');
Route::put('/event/update/{id}',[EventsController::class,'update'])->name('update.p.event');
Route::delete('/event/delete/{id}',[EventsController::class,'destroy'])->name('delete.p.event');

//extended functions for other features
Route::get('/settings', function(){
    return view('settings');
})->name('user.settings');
Route::get('/settings/logout',[UserController::class,'logout'])->name('user.logout');
Route::get('/settings/offline/{id?}',[UserController::class,'logout'])->name('user.offline');
Route::get('/search',[UserController::class,'searchUsers'])->name('user.search');
Route::get('/profile/{id}',[UserController::class,'personalInfo'])->name('user.profile.all');

Route::get('/follow/{id}', [UserController::class,'follows'])->name('follow');
//chat functions
Route::view('chat','chat');
Route::post('/chat',[ChatController::class,'index'])->name('chat.dashboard');
Route::get('/chat/{id}', [ChatController::class,'show'])->name('chat.show');
Route::post('/chats', [ChatController::class,'store'])->name('chat.store');

//extended profiles
Route::post('/user/award', [UserController::class,'addAward'])->name('user.addAward');
Route::post('/user/experiences', [UserController::class,'addExperiences'])->name('user.addExperiences');
Route::post('/user/certificates', [UserController::class,'addCertificates'])->name('user.addCertificates');
Route::post('/user/skills', [UserController::class,'addSkills'])->name('user.addSkills');
Route::post('/user/education', [UserController::class,'addEducation'])->name('user.addEducation');
Route::post('/user/testimonials', [UserController::class,'addTestimonials'])->name('user.addTestimonials');
Route::post('/user/about', [UserController::class,'addAbout'])->name('user.addAbout');
Route::post('/user/volunteer-works', [UserController::class,'addVolunteerWorks'])->name('user.addVolunteerWorks');
Route::post('/user/interests', [UserController::class,'addInterests'])->name('user.addInterests');

