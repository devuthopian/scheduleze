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



Route::group(['middleware' => ['web']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/', 'SchedulezeController@scheduling_solutions');
	Route::get('/demo', 'SchedulezeController@demo')->name('demo');
	Route::get('/faq', 'SchedulezeController@faq')->name('faq');
	Route::get('/signup', 'SchedulezeController@signup')->name('signup');
	Route::get('/contact', 'SchedulezeController@contact')->name('contact');
	Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

	Route::get('/template/{value}', 'PanelController@show');
    Route::post('login/{inspector?}', 'Auth\InspectorAuthController@login');

	Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 
	Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

	Route::group(['middleware' => ['auth']], function() {
		Route::get('/scheduling_solutions', 'SchedulezeController@scheduling_solutions')->name('scheduling_solutions');
		Route::get('/scheduling/schedulepanel', 'SchedulezeController@scheduling_panel')->name('schedulepanel');
		Route::get('/success_stories', 'SchedulezeController@success_stories')->name('success_stories');

		Route::get('/scheduleze/BusinessHours', 'SchedulezeController@BusinessHours');
		Route::get('/scheduleze/appointments','AppointmentController@index');
		Route::get('/scheduleze/Reoccurrence','SchedulezeController@blockouts_occurance')->name('Reoccurrence');
		Route::get('/scheduleze/DriveTime','SchedulezeController@drivetime')->name('Drivetime');
		Route::get('/scheduleze/booking/{form?}','SchedulezeController@Bookings');
		Route::get('/scheduleze/booking/edit/{id?}','SchedulezeController@EditBooking');
		Route::post('/scheduleze/booking/update/{id?}','SchedulezeController@UpdateBooking');
		Route::get('/scheduleze/dayticket/{inspector?}/{days?}/{start?}', 'SchedulezeController@dayticket');
		Route::post('/scheduleze/booking/{form?}','SchedulezeController@BookingFilter');
		Route::get('/scheduleze/blockout/{form?}','SchedulezeController@Blockout');
		Route::post('/scheduleze/blockout/{form?}','SchedulezeController@storeBlockout');
		//Route::get('/scheduleze/blockouts','SchedulezeController@ListBlockout')->name('ListBlockout');

		Route::post('ajaxappointment', 'PanelController@storeAppointment');
		//Route::post('ajaxAppointmentForm', 'PanelController@storeAppointmentForm');
		
		Route::post('/scheduleze/storebusinesshours', 'AppointmentController@storebusinesshours')->name('StoreBusinessHours');
		Route::post('/scheduleze/storedrivetime', 'AppointmentController@storedrivetime')->name('StoreDriveTime');
		Route::post('/scheduleze/storeoffdays', 'AppointmentController@storestoreoffdays')->name('occurrenceoff');
		Route::post('/scheduleze/bookappointment', 'AppointmentController@storebookingappointment')->name('BookAppointment');

		Route::post('/store-template/{value}', 'PanelController@store');
		Route::post('/template/store/{value}', 'PanelController@update');
		Route::get('/load-template/{value}', 'PanelController@index');
		Route::post('/template/images/{value}', 'PanelController@saveimagetemplate');
		
		Route::get('/form/{name?}', 'BuildingController@index')->name('Building');
		Route::post('/storebuild', 'BuildingController@store')->name('storebuild');
		Route::post('/storeException', 'BuildingController@storeException');

		Route::post('/scheduleze/bookingform', 'AppointmentController@bookingform')->name('BookingForm'); //		
		Route::post('/scheduleze/bookingavailable', 'AppointmentController@bookingavailable')->name('BookingAvailable'); //

		Route::post('/ajaxrequest', 'BuildingController@updatebuild');

		Route::get('/business/Location', 'LocationController@index')->name('Location');
		Route::post('/store', 'LocationController@store')->name('storelocation');

		Route::get('/account_info', 'Auth\RegisterController@account_info');
		Route::post('/account_info_save', 'Auth\RegisterController@account_info_save')->name('account_info_save');

		Route::get('/profile', 'ProfileController@UserProfile')->name('profile');
		Route::post('/profile_update', 'ProfileController@updateUserAccount')->name('profile_update');

		Route::get('/business_info', 'ProfileController@UserBusinessProfile')->name('business_info');
		Route::post('/business_info_update', 'ProfileController@updateUserBusinessAccount')->name('business_info_update');

		Route::get('/scheduleze/add_inspector', 'InspectorController@add_inspector')->name('AddInspector');
		Route::post('/inspector/save', 'InspectorController@store')->name('StoreInspector');
	});
});

