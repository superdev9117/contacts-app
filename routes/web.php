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

Route::get('/', 'Auth\LoginController@login');

Route::get('/logout','Auth\LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::post('/add-contact', 'HomeController@addContact')->name('add-contact');
Route::patch('/edit-contact', 'HomeController@editContact')->name('add-contact');
Route::delete('/delete-contact/{id}', 'HomeController@deleteContact')->name('delete-contact');
