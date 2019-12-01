<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Config;

Route::post('/login', 'UserController@login')->name('login');

Route::get('get_site_settings', 'SettingsController@get_site_settings');

Route::get('test', function () {
    $js = \App\Http\Controllers\EmployeesController::sendAccountCreationEmail('irfanullah@techleadz.com', 'John');
    return $js;
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/logout', 'UserController@logout');
    Route::get('/isloggedin', 'UserController@isloggedin');

    // Settings
    Route::post('add_setting', 'SettingsController@add_setting');
    Route::get('get_setting', 'SettingsController@get_setting');
    Route::post('site_configuration', 'SettingsController@site_configuration');
    Route::get('testTbl', 'SettingsController@testTbl');

    Route::group(['prefix' => 'v1'], function () {
        Route::get('profile', 'UserController@profile');
        Route::post('profile', 'UserController@update');

        Route::apiResource('roles', 'RolesController');
        //Route::apiResource('permissions', 'PermissionsController');
        Route::get('/permissions', 'UserController@user_permissions');
        Route::apiResource('employees', 'EmployeesController');

        Route::get('employees_all', 'EmployeesController@employees_all');
        Route::get('permission_by_group', 'PermissionsController@permission_by_group');
        Route::post('roles_assign_permissions', 'RolesController@roles_assign_permissions');
        Route::get('permission_by_role/{role}', 'PermissionsController@permission_by_role');
        //Employe Assign Roles
        Route::get('get_user_role/{user}', 'EmployeesController@get_user_role');
        Route::post('assign_role', 'EmployeesController@assign_role');

        Route::get('all_permissions', 'PermissionsController@index');
        Route::post('permissions', 'PermissionsController@store');
        Route::get('permissions/{permission}', 'PermissionsController@show');
        Route::put('permissions/{permission}', 'PermissionsController@update');
        Route::delete('permissions/{permission}', 'PermissionsController@destroy');

        Route::apiResource('students', 'StudentsController');

        // Route::get('api/students', 'StudentsController@index');
        // Route::post('api/students', 'StudentsController@store');
        // Route::get('api/students/{student}', 'StudentsController@show');
        // Route::put('api/students/{student}', 'StudentsController@update');
        // Route::delete('api/students/{student}', 'StudentsController@destroy');
    });
});
