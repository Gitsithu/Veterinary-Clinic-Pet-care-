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



Route::get('/', function () {
    return view('welcome');
});
Route::get('/', 'frontend\ClinicController@index');
Route::get('frontend/clinic/detail/{id}',        	array('as'=>'frontend/clinic/detail','uses'=>'frontend\ClinicController@detail'));
Route::get('/home/edit/{id}',        	array('as'=>'home/edit','uses'=>'HomeController@edit'));
Route::patch('/home/{id}',      array('as'=>'home/update','uses'=>'HomeController@update'));
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/clinic', 'frontend\ClinicController@clinic');
// Appointment
Route::post('frontend/appointment/create/{id}',  array('as'=>'frontend/appointment/create','uses'=>'frontend\AppointmentController@create'));
Route::post('/frontend/appointment/getbreed',   	array('as'=>'frontend/appointment/getbreed','uses'=>'frontend\AppointmentController@getbreed'));

Route::post('frontend/appointment/store',        	array('as'=>'frontend/appointment/store','uses'=>'frontend\AppointmentController@store'));

Route::get('contact', function () {
    return view('frontend.contact');
});
Route::get('about', function () {
    return view('frontend.about');
});
Route::get('services', function () {
    return view('frontend.services');
});

Route::get('/token',        			array('as'=>'appointment','uses'=>'frontend\AppointmentController@token'));
Route::get('/appointment',        			array('as'=>'appointment','uses'=>'frontend\AppointmentController@index'));

Route::group(['prefix' => 'backend','middleware' => ['auth']], function (){  

// Animal
// Route::get('/animal',        			array('as'=>'animal','uses'=>'backend\AnimalController@index'));
// Route::get('/animal/create',        	array('as'=>'frontend/animal/create','uses'=>'backend\AnimalController@create'));
// Route::post('/animal/store',        	array('as'=>'frontend/animal/store','uses'=>'backend\AnimalController@store'));
// Route::get('/animal/edit/{parameter}',        	array('as'=>'frontend/animal/edit','uses'=>'backend\AnimalController@edit'));
// Route::patch('/animal/update/{id}',      array('as'=>'frontend/animal/update','uses'=>'backend\AnimalController@update'));
// Route::get('/animal/show/{id}',        	array('as'=>'frontend/animal/show','uses'=>'backend\AnimalController@show'));
Route::get('appointment', 'backend\AppointmentController@index');
Route::post('appointment/{id}', 'backend\AppointmentController@reject');
Route::get('appconfirm', 'backend\AppointmentController@appconfirm');
Route::get('appreject', 'backend\AppointmentController@appreject');
Route::get('appointment/{id}/confirm', 'backend\AppointmentController@confirm');

Route::get('dashboard',array('as'=>'dashboard','uses'=>'backend\DashboardController@index'));

Route::resource('animal', 'backend\AnimalController');
// Breed
Route::resource('breed', 'backend\BreedController');

// Clinic
Route::resource('clinic', 'backend\ClinicController');

// user
Route::resource('user', 'backend\UserController');

//home
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home/edit/{parameter}',        	array('as'=>'home/edit','uses'=>'HomeController@edit'));
// Route::patch('/home/{id}',      array('as'=>'home/update','uses'=>'HomeController@update'));

Route::resource('home', 'HomeController');

// Report
Route::get('report/user',        			array('as'=>'pre_report/user','uses'=>'backend\ReportController@index'));
Route::get('report/appointmentaccept',        			array('as'=>'report/appointmentaccept','uses'=>'backend\ReportController@accept'));
Route::get('report/appointmentdeny',        			array('as'=>'report/appointmentdeny','uses'=>'backend\ReportController@deny'));
Route::get('report/appointmentpending',        			array('as'=>'report/appointmentpending','uses'=>'backend\ReportController@pending'));
Route::get('report/clinic',        			array('as'=>'report/clinic','uses'=>'backend\ReportController@clinic'));
Route::get('report/appointment',        			array('as'=>'report/appointment','uses'=>'backend\ReportController@appointment'));
Route::get('report/appointmentexpire',        			array('as'=>'report/appointmentexpire','uses'=>'backend\ReportController@expire'));

});