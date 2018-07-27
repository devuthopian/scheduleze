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

Route::get('/', 'SchedulezeController@scheduling_solutions');
Route::get('/scheduling_solutions', 'SchedulezeController@scheduling_solutions')->name('scheduling_solutions');
Route::get('/schedulepanel', 'SchedulezeController@scheduling_panel')->name('schedulepanel');
Route::get('/success_stories', 'SchedulezeController@success_stories')->name('success_stories');
Route::get('/demo', 'SchedulezeController@demo')->name('demo');
Route::get('/faq', 'SchedulezeController@faq')->name('faq');
Route::get('/signup', 'SchedulezeController@signup')->name('signup');
Route::get('/contact', 'SchedulezeController@contact')->name('contact');
Route::get('/form/{name?}', 'BuildingController@index')->name('Building');
Route::post('/storebuild', 'BuildingController@store')->name('storebuild');
Route::post('/ajaxrequest', 'BuildingController@updatebuild');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/account_info', 'Auth\RegisterController@account_info');
Route::post('/account_info_save', 'Auth\RegisterController@account_info_save')->name('account_info_save');

Route::get('/profile', 'ProfileController@UserProfile')->name('profile');
Route::post('/profile_update', 'ProfileController@updateUserAccount')->name('profile_update');

Route::get('/business_info', 'ProfileController@UserBusinessProfile')->name('business_info');
Route::post('/business_info_update', 'ProfileController@updateUserBusinessAccount')->name('business_info_update');

Route::get('/add_inspector', 'InspectorController@add_inspector')->name('add_inspector');
Route::post('/save_inspector', 'InspectorController@save_inspector')->name('save_inspector');;


/*Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');*/
Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 
Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');