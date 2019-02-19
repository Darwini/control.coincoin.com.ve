<?php
use Illuminate\Http\Request;

Route::get('login', ['as' => 'login', function(){ return view('auth.login'); }]);
Route::any('lock', function(){ Auth::logout(); Session::flash('message-success', 'Sesión Cerrada'); return view('auth.login'); })->name('logout');
Route::post('logueando', ['uses' => 'Auth\LoginController@login'])->name('logueando');
Route::any('/', 'HomeController@index');
Route::any('home', 'HomeController@index')->name('home');
Route::get('changePassword','HomeController@showChangePasswordForm');
Route::post('changePassword','HomeController@changePassword')->name('changePassword');
Route::get('password/reset', ['as' => 'password.request', function () { return view('auth.passwords.email'); }]);
Route::post('password/email', 'Auth\ForgotPasswordController@enviarLink')->name('password.email');
Route::get('changePassword/{d1}/{d2}','UserController@showChangePasswordForm1');
Route::post('recoverPassword','UserController@recoverPassword')->name('recoverPassword');
Route::group(['middleware'=>['web', 'auth']], function(){
  Route::group(['middleware'=>'is_admin'], function(){
	Route::get('Personal/pdf/todos', 'PdfController@Personall')->name('personal.pdf');
	Route::get('Superadmin', function(){ return view('layouts.admin.index'); })->name('todos');
	Route::resource('Admin', 'AdminController', ['except'=>['show','create','edit']]);
  });

  Route::group(['middleware'=>'is_installer'], function(){
	Route::get('Instalador', 'InstaladoresController@index')->name('instalador');
		
	Route::get('Usuarios/equipos', 'InstaladoresController@ViewUsuariosEquipos')->name('usu.equipos');
		
	Route::get('racks/{id}','InstaladoresController@ajaxracks')->name('ajax.racks');
	Route::get('Zonas/Espacios', 'InstaladoresController@ViewZonas')->name('zonas.espacios');
		
	Route::post('Zonas/crearR', 'InstaladoresController@CrearZonaR')->name('crear.rack');
	Route::post('Zonas/editarR', 'InstaladoresController@EditarZonaR')->name('editar.rack');

	Route::post('Zonas/crearA', 'InstaladoresController@CrearZonaA')->name('crear.area');
	Route::post('Zonas/editarA', 'InstaladoresController@EditarZonaA')->name('editar.area');

	Route::post('Zonas/crearS', 'InstaladoresController@CrearZonaS')->name('crear.sala');
	Route::post('Zonas/editarS', 'InstaladoresController@EditarZonaS')->name('editar.sala');
		
	Route::get('Usuarios/pool', 'InstaladoresController@ViewUPool')->name('usuarios.pool');
		
	Route::post('Usuarios/pool/editar', 'InstaladoresController@EditarUPool')->name('editar.user.pool');

	Route::post('Usuario/Cliente', 'InstaladoresController@AsignarUsuarioCliente' )->name('usuario.cliente');

	Route::get('Historial', 'InstaladoresController@HistorialInstalaciones')->name('historial.instalaciones');

	Route::get('buscarusuario/{username}', 'InstaladoresController@ajaxbuscarusuario');
	Route::resource('Alerts', 'AlertController');
	Route::post('Alerts/show', 'AlertController@ajaxshow');

	Route::post('Instalaciones/Pdf', 'PdfController@Instalaciones')->name('instalaciones.pdf');
	Route::post('Usuarios/pool/pdf', 'PdfController@UsuariosPool')->name('usuarios.pool.pdf');

	Route::get('usuarioz', 'ControlPools\IndexPoolControllers@usuarios')->name('usuarioz');

	Route::get('Mineroz', 'ControlPools\IndexPoolControllers@mineros')->name('mineroz');

	Route::post('Usuarios/Mineros', 'InstaladoresController@ViewMinerosPool')->name('detalles.mineros.pool');

	Route::get('user/pool/miner/{puid}','ControlPools\IndexPoolControllers@UserMiner')->name('user.pool.miner');

	Route::post('Ubicar/mineros', 'InstaladoresController@ViewMinersClient')->name('ubicar.pool.local');

	Route::post('Ubicar/pool/minerz', 'InstaladoresController@ProcesarPool')->name('procesar.ubicar.pool');

	Route::post('Minero/Eliminar', 'InstaladoresController@DeleteMiner')->name('delete.miner');
  });
});