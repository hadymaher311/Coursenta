<?php

// Website Home Page
Route::get('/', function () {
    return view('homepage');
});

// Student Auth routes
Auth::routes();
// Student email verification
Route::get('/varifiedEmailStu/{email}/{token}', 'Student\RegisterController@varefied')->name('varifiedEmailStu');

// Student routes
Route::group(['namespace' => 'Student'],function(){
	// get student homepage
	Route::get('/home', 'studentController@index')->name('home');
	// change student profile photo
	Route::post('/student/photo', 'studentController@photo');
	Route::post('/student/update', 'studentController@update_info');

});

// Admin routes
Route::group(['namespace' => 'Admin'],function(){
	// get admin homepage
	Route::GET('admin/home', 'AdminController@index');
	// get admin profile
	Route::GET('admin/profile', 'AdminController@profile');
	// change admin photo
	Route::POST('admin/photo', 'AdminController@photo');
	// update admin data
	Route::POST('admin/update', 'AdminController@update');
	// get courses view for admin
	Route::GET('admin/courses', 'CoursesController@index');
	// admin verify courses
	Route::POST('admin/courses/verify/{id}', 'CoursesController@verify');
	// get professors view for admin
	Route::GET('admin/professors', 'ProfessorsController@index');
	// add new professor Page
	Route::GET('admin/new/professor', 'ProfessorsController@show');
	// add new professor
	Route::POST('admin/new/professor', 'ProfessorsController@store');
	// get students view for admin
	Route::GET('admin/students', 'StudentsController@index');
	// get Employees view for admin
	Route::GET('admin/employees', 'EmployeesController@index');
	// add new employee Page
	Route::GET('admin/new/employee', 'EmployeesController@show');
	// add new employee
	Route::POST('admin/new/employee', 'EmployeesController@store');
	// admin updates room data page
	Route::GET('/admin/rooms/{room}/edit/{branch}', 'RoomsController@edit');
	// admin updates room data
	Route::PATCH('/admin/rooms/{room}/edit/{branch}', 'RoomsController@update');
	// admin deletes room data
	Route::DELETE('/admin/rooms/{room}/delete/{branch}', 'RoomsController@destroy');
	// admin controlls rooms routes
	Route::resource('/admin/rooms', 'RoomsController');
	// get admin login page
	Route::GET('admin','LoginController@showLoginForm')->name('admin.login');
	// login with admin
	Route::POST('admin','LoginController@login');
	// send email for admin to change password
	Route::POST('admin-password/email','ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	// show page of admin to write his email to change password
	Route::GET('admin-password/reset','ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	// reset admin password
	Route::POST('admin-password/reset','ResetPasswordController@reset');
	// get page where admin reset password
	Route::GET('admin-password/reset/{token}','ResetPasswordController@showResetForm')->name('admin.password.reset');
});

// Professor routes
Route::group(['namespace' => 'Professor'],function(){
	// get professor homepage
	Route::GET('professor/home', 'professorController@index');
	// get professor login page
	Route::GET('professor','LoginController@showLoginForm')->name('professor.login');
	// login with professor
	Route::POST('professor','LoginController@login');
	// send email for professor to change password
	Route::POST('professor-password/email','ForgotPasswordController@sendResetLinkEmail')->name('professor.password.email');
	// show page of professor to write his email to change password
	Route::GET('professor-password/reset','ForgotPasswordController@showLinkRequestForm')->name('professor.password.request');
	// reset professor password
	Route::POST('professor-password/reset','ResetPasswordController@reset');
	// get page where professor reset password
	Route::GET('professor-password/reset/{token}','ResetPasswordController@showResetForm')->name('professor.password.reset');
});

// Employee routes
Route::group(['namespace' => 'Employee'],function(){
	// get employee homepage
	Route::GET('employee/home', 'employeeController@index');
	// get employee login page
	Route::GET('employee','LoginController@showLoginForm')->name('employee.login');
	// login with employee
	Route::POST('employee','LoginController@login');
	// send email for employee to change password
	Route::POST('employee-password/email','ForgotPasswordController@sendResetLinkEmail')->name('employee.password.email');
	// show page of employee to write his email to change password
	Route::GET('employee-password/reset','ForgotPasswordController@showLinkRequestForm')->name('employee.password.request');
	// reset employee password
	Route::POST('employee-password/reset','ResetPasswordController@reset');
	// get page where employee reset password
	Route::GET('employee-password/reset/{token}','ResetPasswordController@showResetForm')->name('employee.password.reset');
});
