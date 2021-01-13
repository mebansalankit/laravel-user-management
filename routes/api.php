<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'App\Http\Controllers\RegisterController@register');
Route::post('/login', 'App\Http\Controllers\LoginController@login');


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', 'App\Http\Controllers\LoginController@logout');
    Route::get('/index', 'App\Http\Controllers\IndexController@index');

    Route::post('/createrole/{name}', 'App\Http\Controllers\PermissionsController@createRole');
    Route::post('/createpermission/{name}', 'App\Http\Controllers\PermissionsController@createPermission');
    Route::post('/attachrolepermission/{roleName}/{permissionName}', 'App\Http\Controllers\PermissionsController@attachPermissionToRole');

    Route::post('/attachroletouser/{userId}/{roleName}', 'App\Http\Controllers\PermissionsController@attachRoleToUser');

    Route::get('/roles/{userId}', 'App\Http\Controllers\PermissionsController@getRoles');

    Route::get('/editArticle', 'App\Http\Controllers\PermissionsController@editArticle');
});

