<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('tests', [
	'as'	=> 'admin.tests',
	'uses'	=> 'TestsController@admin'
]);



Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
