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

//LoginController
Route::post('/login', 'App\Http\Controllers\LoginController@login');

Route::prefix('/applications')->group(function () {
    // ApplicationController - Application list
    Route::get('/', 'App\Http\Controllers\ApplicationController@index');
    // count total app exist live & ongoing
//    Route::get('/exist', 'App\Http\Controllers\ApplicationController@count');
    // show either live applications or ongoing applications
//    Route::get('partial-index/{id}', 'App\Http\Controllers\ApplicationController@partialIndex');
    // show details of each application
    Route::get('/{id}', 'App\Http\Controllers\ApplicationController@show');
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    // application write operation
    Route::prefix('/application')->group(function () {
        // ApplicationController - Application list
        Route::post('/', 'App\Http\Controllers\ApplicationController@store');
        //count total app exist live & ongoing
        Route::put('/{id}', 'App\Http\Controllers\ApplicationController@update');
    });

    // UserController
//    Route::resource('/users', 'App\Http\Controllers\UserManagement\UserController')->names([
//        'index' => 'users.index',
//        'create' => 'users.create',
//        'store' => 'users.store',
//        'show' => 'users.show',
//        'edit' => 'users.edit',
//        'update' => 'users.update',
//        'destroy' => 'users.destroy',
//    ]);

    // RoleController
//    Route::resource('/roles', 'App\Http\Controllers\UserManagement\RoleController')->names([
//        'index' => 'roles.index',
//        'create' => 'roles.create',
//        'store' => 'roles.store',
//        'show' => 'roles.show',
//        'edit' => 'roles.edit',
//        'update' => 'roles.update',
//        'destroy' => 'roles.destroy',
//    ]);

    //profile
    Route::get('/profile/{id}', 'App\Http\Controllers\UserProfileController@editProfile')->name('editProfile');
    Route::patch('/profile/{id}', 'App\Http\Controllers\UserProfileController@updateProfile')->name('updateProfile');
});







