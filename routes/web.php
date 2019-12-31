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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/admin/users','Admin\Userscontroller'); syntae optimise ci-dessous

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){ //
    Route::resource('users','Userscontroller');
    Route::resource('products','Productscontroller');
    Route::resource('categories', 'CategoriesController');
    Route::post('/search', 'ProductsController@search')->name('products.search');

});


Route::get('full-text-search', 'Full_text_search_Controller@index');

Route::post('full-text-search/action', 'Full_text_search_Controller@action')->name('full-text-search.action');
Route::get('full-text-search/normal-search', 'Full_text_search_Controller@normal_search')->name('full-text-search.normal-search');

//Route::post('/search', 'Admin\ProductsController@search')->name('products.search');