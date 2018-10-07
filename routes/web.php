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

Route::get('/', 'SiteController@index')->name('index');

Route::get('/home', 'SiteController@index')->name('home');
Route::get('/perfil', 'SiteController@index')->name('perfil');
Route::get('/password', 'SiteController@index')->name('password');
Route::get('/notificaciones', 'SiteController@index')->name('notificaciones');

//Tareas
Route::get('/tareas', 'SiteController@index')->name('tareas');
Route::get('/nueva/tarea', 'TareaController@create')->name('nuevatarea');
Route::post('/crear/tarea', 'TareaController@store')->name('posttarea');

