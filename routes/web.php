<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'SchedulezeController@index');
Route::get('/scheduling_solutions', 'SchedulezeController@scheduling_solutions')->name('scheduling_solutions');
Route::get('/success_stories', 'SchedulezeController@success_stories')->name('success_stories');
Route::get('/demo', 'SchedulezeController@demo')->name('demo');
Route::get('/faq', 'SchedulezeController@faq')->name('faq');
Route::get('/signup', 'SchedulezeController@signup')->name('signup');
Route::get('/contact', 'SchedulezeController@contact')->name('contact');
Route::get('/buildingtypes', 'BuildingController@index')->name('buildingtypes');
Route::get('/storebuildtype', 'BuildingController@store')->name('storebuildtype');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');


