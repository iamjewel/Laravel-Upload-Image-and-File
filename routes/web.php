<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::resource('image', 'ImageController');

Route::resource('file', 'FileController');
