<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/library', 'HomeController@library')->name('library');
    Route::get('/task', 'HomeController@task')->name('task');
    Route::get('/settings', 'HomeController@settings')->name('settings');
    Route::get('/stars', 'HomeController@stars')->name('stars');
    Route::get('/about-us', 'HomeController@about')->name('about');
    Route::get('/', 'HomeController@dashboard')->name('story.selection');
    Route::get('/read/{story}', 'ReadStory@read')->name('story.read');
    Route::get('/read/{story}/quiz', 'ReadStory@quiz')->name('story.quiz');
    Route::post('/read/{story}/quiz/submit', 'ReadStory@assess')->name('story.submit.answers');
    Route::get('/read/{story}/quiz/result', 'ReadStory@result')->name('story.quiz.result');
    Route::get('/read/{story}/quiz/retake', 'ReadStory@retake')->name('story.quiz.retake');

    Route::post('/me/update', 'ProfileController@update')->name('profile.update');
});

Route::get('/signup', "Console\User\UserSignup@form")->name('signup');
Route::post('/signup', "Console\User\UserSignup@signup")->name('signup.submit');


Route::get('/hash/{string}', function($string){
    return Hash::make($string);
});