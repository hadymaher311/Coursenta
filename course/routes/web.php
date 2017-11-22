<?php


Route::get('/', function () {
    return view('homepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/varifiedEmailStu/{email}/{token}', 'Auth\RegisterController@varefied')->name('varifiedEmailStu');
