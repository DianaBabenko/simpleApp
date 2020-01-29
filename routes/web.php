<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/send','MailController@send')->name('send');

Route::group(['prefix' => 'digging_deeper',], function() {
    Route::get('collections', 'DiggingDeeperController@collections')
        ->name('digging_deeper.collections');
});

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'PostController')
        ->names('blog.posts');
});


//Admin page
$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog'
];

Route::group($groupData, function() {
    //BlogCategory
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    //BlogPost
    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts')
        ->middleware('auth')
        ->middleware('balance');
});


//Route::resource('rest', 'RestTestController')->names('restTest');





