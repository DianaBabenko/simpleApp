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

Route::middleware('auth:api')->get('/user', static function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'categories'], static function() {
    Route::get('/', 'Api\Blog\Admin\CategoriesController@index');
    Route::get('/{id}', 'Api\Blog\Admin\CategoriesController@show');
    Route::post('/', 'Api\Blog\Admin\CategoriesController@store');
    Route::put('/{id}', 'Api\Blog\Admin\CategoriesController@update');
    Route::delete('/{id}', 'Api\Blog\Admin\CategoriesController@delete');
});
