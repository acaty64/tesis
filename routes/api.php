<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('syllabus', 'Api\SyllabusController');

Route::get('cambios/index', [
	'as'	=> 'cambios.index',
	'uses'	=> 'Api\CambioController@index'
]);
Route::get('cambios/upload', [
	'as'	=> 'cambios.upload',
	'uses'	=> 'Api\CambioController@upload'
]);
Route::post('cambios/change', [
	'as'	=> 'cambios.change',
	'uses'	=> 'Api\CambioController@change'
]);

Route::get('processing-status', function()
{
    return Session::get('progress');
});

Route::post('/index', [
	'as'	=> 'index',
	'uses'	=> 'Api\SyllabusController@index'
]);

Route::post('/saveData', [
	'as'	=> 'saveData',
	'uses'	=> 'Api\SyllabusController@saveData'
]);

Route::post('/deleteData', [
	'as'	=> 'deleteData',
	'uses'	=> 'Api\SyllabusController@deleteData'
]);

Route::post('/upload/evaluaciones', [
	'as'	=> 'upload',
	'uses'	=> 'Api\SyllabusController@upload_evaluaciones'
]);

/* Acceso Administrador, Master  */
Route::post('/descarga', [
	'as'	=> 'descarga.grupo',
	'uses'	=> 'Api\DownloadController@descargaGrupo'
]);

/* Acceso Administrador, Master  */
Route::get('downloadGrupo', [
	'as'	=> 'downloadGrupo',
	'uses'	=> 'Api\DownloadController@downloadGrupo'
]);
