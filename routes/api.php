<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Config;


Route::post('/login', 'API\UserController@login')->name('login');

Route::get('get_site_settings', 'API\Admin\SettingsController@get_site_settings');

Route::get('test', function(){
	$js =  \App\Http\Controllers\API\Admin\EmployeesController::sendAccountCreationEmail('irfanullah@techleadz.com', 'John');
	return $js;
});

Route::group(['middleware' => 'auth:api'], function(){

	Route::get('/logout', 'API\UserController@logout');
	
	Route::get('/isloggedin', 'API\UserController@isloggedin');

	// Settings
	Route::post('add_setting', 'API\Admin\SettingsController@add_setting');
	Route::get('get_setting', 'API\Admin\SettingsController@get_setting');
	Route::post('site_configuration', 'API\Admin\SettingsController@site_configuration');
	Route::get('testTbl', 'API\Admin\SettingsController@testTbl');

	
	Route::group(["prefix" => 'v1'], function() {

		Route::get('profile', 'API\UserController@profile');
		Route::post('profile', 'API\UserController@update');



	    Route::apiResource('roles', 'API\Admin\RolesController');
	    Route::apiResource('permissions', 'API\Admin\PermissionsController');
	    Route::get('/permissions','API\UserController@user_permissions');
	    
	    Route::apiResource('employees', 'API\Admin\EmployeesController');

	    Route::get('employees_all', 'API\Admin\EmployeesController@employees_all');

	    Route::get('permission_by_group', 'API\Admin\PermissionsController@permission_by_group');
	    Route::post('roles_assign_permissions', 'API\Admin\RolesController@roles_assign_permissions');
	    
	    Route::get('permission_by_role/{role}', 'API\Admin\PermissionsController@permission_by_role');
	    
		//Employe Assign Roles
		Route::get('get_user_role/{user}', 'API\Admin\EmployeesController@get_user_role');
		Route::post('assign_role', 'API\Admin\EmployeesController\@assign_role');
		

	});
});