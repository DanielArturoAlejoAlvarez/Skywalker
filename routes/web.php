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
    return redirect()->route('blog');
});


Auth::routes();

//CLIENT
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('blog','Web\PageController@blog')->name('blog');
Route::get('blog/{slug}','Web\PageController@post')->name('post');
Route::get('blog/category/{slug}','Web\PageController@category')->name('category');
Route::get('blog/tag/{slug}','Web\PageController@tag')->name('tag');

//ADMIN
Route::resource('tags','Admin\TagController');
Route::resource('categories','Admin\CategoryController');
Route::resource('posts','Admin\PostController');