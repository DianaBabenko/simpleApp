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

Route::get('/', static function () {
    return view('welcome');
});

Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');
Route::post('file-upload', 'UploadController@upload')->name('file.upload.post');

Route::get('upload-advanced', 'UploadController@upload');
Route::post('upload-advanced', 'UploadController@upload');

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/send','MailController@send')->name('send');

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], static function () {
    Route::resource('posts', 'PostController')
        ->names('blog.posts');
});

$adminGroup = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog',
    'middleware' => ['auth'],
];

Route::group($adminGroup, static function() {
    $methods = ['index', 'edit', 'update', 'create', 'store'];
    Route::resource('categories', 'CategoryController')
        ->only($methods)
        ->names('blog.admin.categories');

    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts')
        ->middleware('balance');
});

Route::view('test-passport','passport');
