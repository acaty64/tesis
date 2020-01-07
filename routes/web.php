<?php 

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::auth();

Route::get('prueba', [
	'as'	=> 'test',
	'uses'	=> 'Sys\ArchivoController@index'
]);

Route::get('sequence/apply/{id?}', [
	'as'	=> 'sequence.apply',
	'uses'	=> 'SequenceController@apply'
]);

// Route::get('sequence/show/{id}/{thesis_id?}', function ()
// {
// 	return ('route');
// })->name('sequence.show');

Route::get('sequence/show/{id}/{thesis_id?}', [
	'as'	=> 'sequence.show',
	'uses'	=> 'SequenceController@show'
]);

Route::get('sequence/show2/{user_id}/{thesis_id}', [
	'as'	=> 'sequence.show2',
	'uses'	=> 'SequenceController@show2'
]);


/* DOCUMENTS */
Route::post('document/up10', [
	'as'	=> 'document.up10',
	'uses'	=> 'DocumentController@up10'
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
// Route::post('password/email', [
// 	'as'	=> 'password.email',
// 	'uses'	=> 'Auth\ForgotPasswordController@sendResetLinkEmail'
// ]);
// Route::get('password/reset', [
// 	'as'	=> 'password.request',
// 	'uses'	=> 'Auth\ForgotPasswordController@showLinkRequestForm'
// ]);
// Route::post('password/reset', [
// 	'as'	=> '',
// 	'uses'	=> 'Auth\ResetPasswordController@reset'
// ]);
// Route::get('password/reset/{token}', [
// 	'as'	=> 'password.reset',
// 	'uses'	=> 'Auth\ResetPasswordController@showResetForm'
// ]);
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



Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
