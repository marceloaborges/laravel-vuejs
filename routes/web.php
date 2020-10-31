<?php


Route::group([
	'middleware' => ['web','auth'],
	'prefix' => 'sys', // Prefixo utilizado antes do caminho de rota sys/user, UserController@index
	'namespace' => 'Sys', // Permite remover o namespace utilizando antes da chamada do método Sys\UserController@index
	'as' => 'sys.', //susbtitui name
	], 
	function (){

		Route::get('/', 'DashboardController@index')->name('dashboard');

		//Users
		Route::resource('users', 'UserController');
		Route::any('users/search', 'UserController@search')->name('users.search');

		//Funções/Papeis do sistema
		Route::resource('roles', 'RoleController');
		Route::any('roles/search', 'RoleController@search')->name('roles.search');

		//Testes
		Route::resource('testes', 'TesteController');

		//Roles for users
		//Route::get('users/{id}/roles', 'UserController@rolesList')->name('users.roles.index');
		Route::post('users/{id}/roles', 'UserController@rolesStore')->name('users.roles.store');
		Route::delete('users/{user_id}/roles/{role_id}', 'UserController@rolesDestroy')->name('users.roles.destroy');

		//Permissions for roles
		Route::post('roles/{id}/permissions', 'RoleController@permissionsStore')->name('roles.permissions.store');
		Route::delete('roles/{role_id}/permission/{permission_id}', 'RoleController@permissionsDestroy')->name('roles.permissions.destroy');

		/*Route::get('/403', function(){
			$active = 'home'; 
			return view('layouts.403', compact('active'));
		})->name('403');*/

		
});

Auth::routes(['register' => false]);

// Route::redirect('/', '/sys');

Route::get('/', 'Auth\AuthController@login')->middleware('auth');
Route::post('/login', 'Auth\AuthController@authenticated')->name('login');
