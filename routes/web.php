<?php

Route::get('job', function(){
	
	dispatch(new App\Jobs\SendEmail);

	return "Listo!";
});

Route::resource('mensajes', 'MessagesController');

Route::resource('usuarios', 'UsersController');

Route::get('login', 'Auth\LoginController@showLoginForm');

Route::post('login', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

Route::get('saludos/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])-> where('nombre', "[A-Za-z]+");