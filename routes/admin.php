<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' =>'App\Http\Controllers\Admin','prefix'=>'admin'],function() {

    // Start Login Admin Routes
    Route::group(['middleware'=>'guest:admin'], function () {
        Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
        Route::post('login', 'LoginController@login')->name('admin.login');
    });


    // Start Dashboard Admin Routes
    Route::group(['middleware'=>'auth:admin'], function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
        Route::post('logout','LoginController@logout')->name('admin.logout');

        // Start Posts Routes
        Route::group(['prefix'=>'posts'], function () {
            Route::get('/', 'PostController@index')->name('admin.posts.index');
            Route::get('/create-post', 'PostController@create')->name('admin.posts.create');
            Route::post('/store', 'PostController@store')->name('admin.posts.store');
            Route::get('/edit-post', 'PostController@edit')->name('admin.posts.edit');
            Route::post('/update', 'PostController@update')->name('admin.posts.update');
            Route::post('/delete', 'PostController@delete')->name('admin.posts.delete');
        });

        // Start categories Routes
        Route::group(['prefix'=>'categories'], function () {
            Route::get('/', 'CategoryController@index')->name('admin.categories.index');
            Route::post('/store', 'CategoryController@store')->name('admin.categories.store');
            Route::post('/update', 'CategoryController@update')->name('admin.categories.update');
            Route::post('/delete', 'CategoryController@delete')->name('admin.categories.delete');
        });


    });

});




