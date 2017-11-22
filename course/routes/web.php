<?php


Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::get('/home', 'Student\studentController@index')->name('home');

Route::get('/varifiedEmailStu/{email}/{token}', 'Student\RegisterController@varefied')->name('varifiedEmailStu');
