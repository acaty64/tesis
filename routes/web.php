<?php 

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Route::auth();

Route::get('prueba', [
	'as'	=> 'test',
	'uses'	=> 'Sys\ArchivoController@index'
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

/* Acceso Consulta, Docente, Responsable, Administrador, Master 
Route::get('/user/redirect', [
	'as'	=> 'user.redirect',
	'uses'	=> 'UserAccesoController@redirect'
]);
 */

/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('/malla/{siglas}', [
	'as'	=> 'malla',
	'uses'	=> 'MallaController@index'
]);

/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('PDF/malla/{siglas}', [
	'as'	=> 'PDF.malla',
	'uses'	=> 'PDFController@malla'
]);


/* Acceso Consulta, Docente, Responsable, Administrador, Master   */
Route::get('/show/{semestre}/{cod_curso}', [
	'as'	=> 'curso.show',
	'uses'	=> 'CursoController@show'
]);

/* Acceso Consulta, Docente, Responsable, Administrador, Master  
Route::get('/show/{semestre}/{cod_curso}/{edit}', [
	'as'	=> 'curso.show',
	'uses'	=> 'CursoController@show'
]);
*/

/* Acceso Responsable, Administrador, Master  */
Route::get('/syllabus/show', [
	'as'	=> 'syllabus.show',
	'uses'	=> 'SyllabusController@show'
]);

/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('/cursos/index', [
	'as'	=> 'cursos.index',
	'uses'	=> 'CursoController@index'
]);

/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('/PDF/syllabus/{semestre}/{cod_curso}/{view}/{message}', [
	'as'	=> 'PDF',
	'uses'	=> 'PDFController@ViewSyllabus'
]);

/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('/header/PDF/syllabus/{semestre}', function ($semestre) {
    return view('layouts.partials.header_PDF', ['semestre'=>$semestre]);
});

/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('/footer/PDF/syllabus/{semestre}', function ($semestre) {
    return view('layouts.partials.footer_PDF', ['semestre'=>$semestre]);
});


/* Acceso Consulta, Docente, Responsable, Administrador, Master  */
Route::get('/downloadFile/{fileName}/{type}', [
	'as'	=> 'download.file',
	'uses'	=> 'Api\DownloadController@downloadFile'
]);


/*  Pagina en construccion       */
Route::get('enConstruccion', function()
{
	return view('enConstruccion');
});