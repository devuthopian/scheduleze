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
Route::get('/buildingsizes', 'BuildingController@buildsizes')->name('buildingsizes');
Route::post('/storebuildtype', 'BuildingController@store')->name('storebuildtype');
Route::post('/storebuildsizes', 'BuildingController@storebuildsizes')->name('storebuildsizes');
Route::post('/ajaxrequest', 'BuildingController@updatebuild');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/account_info', 'Auth\RegisterController@account_info');
Route::post('/account_info_save', 'Auth\RegisterController@account_info_save')->name('account_info_save');

Route::get('/profile', 'ProfileController@UserProfile')->name('profile');

 Route::put('profile/{username}/profile', [
        'as'   => '{username}',
        'uses' => 'ProfileController@updateUserAccount',
    ]);



