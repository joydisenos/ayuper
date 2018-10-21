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
Route::get('/password', 'SiteController@index')->name('password');
Route::get('/notificaciones', 'SiteController@index')->name('notificaciones');

//alta
Route::get('/alta', 'AltaController@alta')->name('alta');

//Bienvenida
Route::get('/bienvenido', 'BienvenidaController@bienvenida')->name('bienvenida');

//Tareas
Route::get('/tarea/{id}', 'TareaController@show')->name('tarea');
Route::get('/modificar/tarea/{id}', 'TareaController@edit')->name('modificartarea');
Route::get('/eliminar/tarea/{id}', 'TareaController@destroy')->name('eliminartarea');
Route::post('/actualiza/tarea/{id}', 'TareaController@update')->name('actualizartarea');
Route::get('/mistareas', 'TareaController@index')->name('mistareas');
Route::get('/nueva/tarea', 'TareaController@create')->name('nuevatarea');
Route::post('/crear/tarea', 'TareaController@store')->name('posttarea');

//Perfil
Route::get('/perfil', 'PerfilController@index')->name('perfil');
Route::post('completar/perfil', 'PerfilController@store')->name('completarperfil');
Route::post('/actualizar/perfil/{id}', 'PerfilController@update')->name('actualizarperfil');
Route::post('/cambio/password', 'PerfilController@password')->name('cambiarpassword');

//Listado
Route::get('/buscar/clientes', 'ListadoController@clientes')->name('clientes');
Route::get('/buscar/profesionales', 'ListadoController@profesionales')->name('profesionales');

//Presupuesto
Route::post('/enviar/presupuesto', 'PresupuestoController@store')->name('enviarpresupuesto');
Route::get('/aceptar/{presupuesto}/{tarea}', 'PresupuestoController@aceptar')->name('aceptarpresupuesto');
Route::get('/negar/{presupuesto}', 'PresupuestoController@negar')->name('negarpresupuesto');

//Admin
Route::get('/todos/usuarios', 'AdminController@usuarios')->name('usuariosregistrados');
Route::get('/eliminar/usuario/{id}', 'AdminController@eliminarusuario')->name('eliminarusuario');
Route::get('/todas/tareas', 'AdminController@tareas')->name('todastareas');
Route::get('/todas/servicios', 'AdminController@servicios')->name('servicios');
Route::post('/actualizar/usuario', 'AdminController@actualizarusuario')->name('actualizarusuario');
Route::get('/presupuestos/negados', 'AdminController@presupuestosnegados')->name('presupuestosnegados');

	//Servicios
	Route::post('/nuevo/servicio', 'ServicioController@store')->name('nuevoservicio');
	Route::get('/eliminar/servicio/{id}', 'ServicioController@destroy')->name('eliminarservicio');

//Notificaciones
Route::get('/notificacion/{id}', 'NotificacionController@notificacion')->name('notificacion');
Route::get('/notificaciones/pendientes', 'NotificacionController@notificaciones')->name('notificacionespendientes');
Route::get('/not/{id}/{estatus}', 'NotificacionController@estatus')->name('notificacionestatus');

//Como Funciona
Route::get('/como-funciona', 'FuncionaController@index')->name('funciona');
