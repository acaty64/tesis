<?php 

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::auth();

Route::get('prueba', [
	'as'	=> 'test',
	'uses'	=> 'Sys\ArchivoController@index'
]);

Route::get('sequence/show/{id}/{thesis_id?}', [
	'as'	=> 'sequence.show',
	'uses'	=> 'SequenceController@show'
]);

// THESIS
Route::get('thesis/email/{deal_id}', [
	'as'	=> 'thesis.email',
	'uses'	=> 'ThesisController@email'
]);

Route::get('thesis/index', [
	'as'	=> 'thesis.index',
	'uses'	=> 'ThesisController@index'
]);

Route::get('thesis/create', [
	'as'	=> 'thesis.create',
	'uses'	=> 'ThesisController@create'
]);

Route::post('thesis/store', [
	'as'	=> 'thesis.store',
	'uses'	=> 'ThesisController@store'
]);

Route::get('thesis/edit/{id}', [
	'as'	=> 'thesis.edit',
	'uses'	=> 'ThesisController@edit'
]);

Route::post('thesis/upload', [
	'as'	=> 'thesis.upload',
	'uses'	=> 'ThesisController@upload'
]);

Route::get('thesis/destroy/{id}', [
	'as'	=> 'thesis.destroy',
	'uses'	=> 'ThesisController@destroy'
]);

/* USERS */
Route::get('users/index', [
	'as'	=> 'user.index',
	'uses'	=> 'UserController@index'
]);

/* Ruta auth()  */
Route::get('login', [
	'as'	=> 'login',
	'uses'	=> 'Auth\LoginController@showLoginForm'
]);

Route::post('login', [
	'as'	=> '',
	'uses'	=> 'Auth\LoginController@login'
]);
Route::get('logout', [
	'as'	=> 'logout',
	'uses'	=> 'Auth\LoginController@logout'
]);
Route::post('logout', [
	'as'	=> 'logout',
	'uses'	=> 'Auth\LoginController@logout'
]);
Route::post('password/email', [
	'as'	=> 'password.email',
	'uses'	=> 'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::get('password/reset', [
	'as'	=> 'password.request',
	'uses'	=> 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
	'as'	=> '',
	'uses'	=> 'Auth\ResetPasswordController@reset'
]);
Route::get('password/reset/{token}', [
	'as'	=> 'password.reset',
	'uses'	=> 'Auth\ResetPasswordController@showResetForm'
]);
/*  Fin rutas auth()               */

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
	return view('welcome');
});


/*  Pagina en construccion       */
Route::get('enConstruccion', function()
{
	return view('enConstruccion');
});