<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('tests', [
	'as'	=> 'admin.tests',
	'uses'	=> 'TestsController@admin'
]);

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
