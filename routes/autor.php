<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('autor/tests', [
	'as'	=> 'autor.tests',
	'uses'	=> 'TestsController@autor'
]);




Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
