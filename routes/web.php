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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@show']);


Route::group(['middleware'=>'admin'], function(){
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/photos','AdminPhotosController');

    Route::resource('admin/comments', 'PostsCommentsController');

    Route::resource('admin/comment/replies', 'CommentRepliesController');


    Route::get('/admin', function (){
        return view('admin.index');
    });
});

Route::group(['middleware'=>'auth'], function(){

    Route::post('commet/reply', 'CommentRepliesController@createReply');
});





