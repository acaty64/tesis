<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('sys/tests', [
	'as'	=> 'sys.tests',
	'uses'	=> 'TestsController@master'
]);

Route::get('backup', [
	'as'	=> 'backup.index',
	'uses'	=> 'Sys\BackupController@index'
]);


Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
