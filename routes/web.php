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

	Route::get('/cookie/set', 'CookieController@setCookie');
	Route::get('/cookie/get', 'CookieController@getCookie');

	Route::get('/ConfirmStatus', 'SchedulezeController@confirm_status');

	Route::get('/template/{value}', 'PanelController@show');
	Route::get('/scheduling_solutions', 'SchedulezeController@scheduling_solutions')->name('scheduling_solutions');
	Route::get('/scheduling_faq', 'SchedulezeController@scheduling_faq');
    Route::post('login/{inspector?}', 'Auth\InspectorAuthController@login');

	Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
 
	Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
	Route::get('/success_stories', 'SchedulezeController@success_stories')->name('success_stories');

	Route::get('/account_info', 'Auth\RegisterController@account_info');
	Route::post('/account_info_save', 'Auth\RegisterController@account_info_save')->name('account_info_save');

	Route::group(['prefix' => 'faq', 'namespace' => 'Website'], function () {
	    Route::get('', 'FAQController@index');
	    Route::post('/question/{faq}/{type?}', 'FAQController@incrementClick');
	});
	Route::group(['namespace' => 'Admin\FAQ'], function () {
	    Route::resource('/faqs/categories', 'CategoriesController');
	    Route::get('faqs/order', 'OrderController@index');
	    Route::post('faqs/order', 'OrderController@updateOrder');
	    Route::resource('/faqs', 'FAQsController');
	});

	Route::post('/faqs/{faqId?}/{action?}', 'Website\FAQController@faqsAction');

	Route::post('/scheduling/bookingform', 'AppointmentController@bookingform')->name('BookingForm'); //		
	Route::post('/scheduling/bookingavailable', 'AppointmentController@bookingavailable')->name('BookingAvailable'); //
	Route::post('/scheduleze/bookappointment', 'AppointmentController@storebookingappointment')->name('BookAppointment');
	Route::get('/appointment/receipt/{id?}','AppointmentController@reciept');

	/*Route::get('/faq', 'FAQController@index');
	Route::post('/faq/question/{faq}/{type?}', 'FAQController@incrementClick');

	Route::group(['namespace' => 'FAQ'], function () {
	    Route::resource('/faqs/categories', 'CategoriesController');
	    Route::get('faqs/order', 'OrderController@index');
	    Route::post('faqs/order', 'OrderController@updateOrder');
	    Route::resource('/faqs', 'FaqsController');
	});*/

	Route::group(['middleware' => ['auth']], function() {
		
		Route::get('/scheduling/schedulepanel', 'SchedulezeController@scheduling_panel')->name('schedulepanel');

		Route::post('/scheduling/update_template_url', 'SchedulezeController@UpdateTemplateUrl');

		Route::get('/scheduleze/BusinessHours', 'SchedulezeController@BusinessHours');
		Route::post('/scheduleze/BusinessHours', 'SchedulezeController@BusinessHours');
		Route::get('/scheduleze/appointments','AppointmentController@index');
		Route::get('/scheduleze/Reoccurrence','SchedulezeController@blockouts_occurance')->name('Reoccurrence');
		Route::post('/scheduleze/Reoccurrence','SchedulezeController@blockouts_occurance');
		Route::get('/scheduleze/DriveTime','SchedulezeController@drivetime')->name('Drivetime');
		Route::get('/scheduleze/booking/{form?}/{userid?}','SchedulezeController@Bookings');
		Route::get('/scheduleze/booking/form/edit/{id?}','SchedulezeController@EditBooking');
		Route::get('/scheduleze/booking/delete/{id?}','SchedulezeController@DeleteBooking');
		Route::post('/scheduleze/booking/update/{id?}','SchedulezeController@UpdateBooking');
		Route::get('/scheduleze/dayticket/{inspector?}/{days?}/{start?}', 'SchedulezeController@dayticket');
		Route::post('/scheduleze/booking/{form?}','SchedulezeController@BookingFilter');
		Route::get('/scheduleze/blockout/{form?}/{id?}','SchedulezeController@Blockout');
		Route::post('/scheduleze/blockout/{form?}','SchedulezeController@storeBlockout');
		Route::get('/services/content', 'SchedulezeController@changeContent');
		Route::post('/services/content', 'SchedulezeController@changeContent');
		Route::get('/scheduleze/mapmyday/{location?}', 'SchedulezeController@mapmyday');

		Route::get('/scheduleze/zigzag','SchedulezeController@ZigZag')->name('ZigZag');
		Route::post('/scheduleze/zigzag','SchedulezeController@storeZigZag');

		Route::get('/scheduleze/documents','SchedulezeController@Documents')->name('Document');
		Route::post('/scheduleze/documents', 'SchedulezeController@DocumnetFilter');
		Route::get('/scheduleze/documents/viewreport/{booking?}', 'SchedulezeController@DocumnetReport');
		Route::post('/scheduleze/save/report', 'SchedulezeController@SaveReport');
		Route::get('/viewreports/{id?}/{code?}/{go?}', 'SchedulezeController@ViewReport');
		//Route::get('/scheduleze/blockouts','SchedulezeController@ListBlockout')->name('ListBlockout');

		Route::post('ajaxappointment', 'PanelController@storeAppointment');
		//Route::post('ajaxAppointmentForm', 'PanelController@storeAppointmentForm');
		
		Route::post('/scheduleze/storebusinesshours', 'AppointmentController@storebusinesshours')->name('StoreBusinessHours');
		Route::post('/scheduleze/storedrivetime', 'AppointmentController@storedrivetime')->name('StoreDriveTime');
		Route::post('/scheduleze/storeoffdays', 'AppointmentController@storestoreoffdays')->name('occurrenceoff');

		Route::post('/store-template/{value}', 'PanelController@store');
		Route::post('/template/store/{value}', 'PanelController@update');
		Route::get('/load-template/{value}/{panel_defualt?}', 'PanelController@index');
		Route::post('/template/images/{value}', 'PanelController@saveimagetemplate');
		
		Route::get('/form/{name?}', 'BuildingController@index')->name('Building');
		Route::post('/storebuild', 'BuildingController@store')->name('storebuild');
		Route::post('/storeException', 'BuildingController@storeException');
		Route::post('/services/storeServiceContent', 'BuildingController@storeServiceContent');
		

		Route::post('/ajaxrequest', 'BuildingController@updatebuild');

		Route::get('/business/Location', 'LocationController@index')->name('Location');
		Route::post('/store', 'LocationController@store')->name('storelocation');

		

		Route::get('/profile/{id?}', 'ProfileController@UserProfile')->name('profile');
		Route::get('/profile/remove/{id?}', 'ProfileController@RemoveUserProfile');
		Route::get('/profile/Email/Attachment', 'SchedulezeController@EmailAttachment');
		Route::post('/profile/Email/Attachment', 'ProfileController@SaveEmailAttachment');
		Route::post('/profile_update', 'ProfileController@updateUserAccount')->name('profile_update');

		Route::get('/business_info', 'ProfileController@UserBusinessProfile')->name('business_info');
		Route::post('/business_info_update', 'ProfileController@updateUserBusinessAccount')->name('business_info_update');

		Route::get('/scheduleze/add_inspector', 'InspectorController@add_inspector')->name('AddInspector');
		Route::get('/scheduleze/inspectors', 'InspectorController@Inspectors')->name('Inspectors');
		Route::post('/inspector/save', 'InspectorController@store')->name('StoreInspector');
	});
});

