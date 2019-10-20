<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('tests', [
	'as'	=> 'asesor.tests',
	'uses'	=> 'TestsController@asesor'
]);




Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
