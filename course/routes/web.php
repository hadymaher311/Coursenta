<?php


Route::get('/', function () {
    return view('homepage');
});
-
Auth::routes();
Route::group(['namespace' => 'Student'],function(){
	Route::get('/home', 'studentController@index')->name('home');
	Route::post('/student/photo', 'studentController@photo');
	Route::post('/student/update', 'studentController@update_info');

});

Route::get('/varifiedEmailStu/{email}/{token}', 'Student\RegisterController@varefied')->name('varifiedEmailStu');


Route::group(['namespace' => 'Admin'],function(){
	Route::GET('admin/home', 'AdminController@index');
	Route::GET('admin/profile', 'AdminController@profile');
	Route::POST('admin/photo', 'AdminController@photo');
	Route::POST('admin/update', 'AdminController@update');
	Route::GET('admin','LoginController@showLoginForm')->name('admin.login');
	Route::POST('admin','LoginController@login');
	Route::POST('admin-password/email','ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::GET('admin-password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::POST('admin-password/reset','ResetPasswordController@reset');
	Route::GET('admin-password/reset/{token}','ResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group(['namespace' => 'Professor'],function(){
	Route::GET('professor/home', 'professorController@index');
	Route::GET('professor','LoginController@showLoginForm')->name('professor.login');
	Route::POST('professor','LoginController@login');
	Route::POST('professor-password/email','ForgotPasswordController@sendResetLinkEmail')->name('professor.password.email');
	Route::GET('professor-password/reset','ForgotPasswordController@showLinkRequestForm')->name('professor.password.request');
	Route::POST('professor-password/reset','ResetPasswordController@reset');
	Route::GET('professor-password/reset/{token}','ResetPasswordController@showResetForm')->name('professor.password.reset');
});

Route::group(['namespace' => 'Employee'],function(){
	Route::GET('employee/home', 'employeeController@index');
	Route::GET('employee','LoginController@showLoginForm')->name('employee.login');
	Route::POST('employee','LoginController@login');
	Route::POST('employee-password/email','ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
	Route::GET('employee-password/reset','ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
	Route::POST('employee-password/reset','ResetPasswordController@reset');
	Route::GET('employee-password/reset/{token}','ResetPasswordController@showResetForm')->name('employee.password.reset');
});
