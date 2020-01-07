<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('admin/tests', [
	'as'	=> 'admin.tests',
	'uses'	=> 'TestsController@admin'
]);

////// THESIS /////////////////

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

Route::post('thesis/update', [
	'as'	=> 'thesis.update',
	'uses'	=> 'ThesisController@update'
]);

Route::get('thesis/destroy/{id}', [
	'as'	=> 'thesis.destroy',
	'uses'	=> 'ThesisController@destroy'
]);
// THESIS
Route::get('thesis/email/{deal_id}', [
	'as'	=> 'thesis.email',
	'uses'	=> 'ThesisController@email'
]);

///////////////////////////////
// AUTH
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
///////////////////////////////

/////////// USERS ///////////
Route::post('users/store', [
	'as'	=> 'users.store',
	'uses'	=> 'UserController@store'
]);

Route::get('users/index', [
	'as'	=> 'users.index',
	'uses'	=> 'UserController@index'
]);

Route::get('users/create', [
	'as'	=> 'users.create',
	'uses'	=> 'UserController@create'
]);

Route::get('users/show/{id}', [
	'as'	=> 'users.show',
	'uses'	=> 'UserController@show'
]);

Route::get('users/edit/{id}', [
	'as'	=> 'users.edit',
	'uses'	=> 'UserController@edit'
]);

Route::get('users/destroy/{id}', [
	'as'	=> 'users.destroy',
	'uses'	=> 'UserController@destroy'
]);
/////////// USERS ///////////



Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
