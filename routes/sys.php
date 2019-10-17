<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::get('backup', [
	'as'	=> 'backup.index',
	'uses'	=> 'Sys\BackupController@index'
]);

Route::get('backup/destroy/{file}', [
	'as'	=> 'backup.destroy',
	'uses'	=> 'Sys\BackupController@destroy'
]);

Route::get('backup/create', [
	'as'	=> 'backup.create',
	'uses'	=> 'Sys\BackupController@create'
]);

Route::get('backup/download/{file}', [
	'as'	=> 'backup.download',
	'uses'	=> 'Sys\BackupController@download'
]);

Route::get('backup/restore/{file}', [
	'as'	=> 'backup.restore',
	'uses'	=> 'Sys\BackupController@restore'
]);

Route::get('index_semestre', [
	'as'	=> 'semestre.index',
	'uses'	=> 'Sys\SemestreController@index'
]);

Route::post('create_semestre', [
	'as'	=> 'semestre.create',
	'uses'	=> 'Sys\SemestreController@create'
]);




Route::fallback(function()
{
	return response('Página no encontrada', 404);
});
