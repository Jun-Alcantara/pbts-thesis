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
    Route::get('/', 'HomeController@index')->name('story.selection');
    Route::get('/read/{story}', 'ReadStory@read')->name('story.read');
    Route::get('/read/{story}/quiz', 'ReadStory@quiz')->name('story.quiz');
    Route::post('/read/{story}/quiz/submit', 'ReadStory@assess')->name('story.submit.answers');
    Route::get('/read/{story}/quiz/result', 'ReadStory@result')->name('story.quiz.result');
});


Route::get('/hash/{string}', function($string){
    return Hash::make($string);
});