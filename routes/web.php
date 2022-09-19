<?php

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

Route::get('/', function () {
    if (Auth::Check()){
        return redirect('/home');
    }
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// Category routes
Route::resource('category','CategoryController');
Route::get('/request/category','CategoryController@cat_request')->name('category.request');
Route::get('/approve/category/{id}','CategoryController@cat_approve')->name('category.approve');
//Sub Category Routes
Route::resource('subcategory','SubCategoryController');
Route::get('/request/sub_category','SubCategoryController@subcat_request')->name('subcategory.request');
Route::get('/approve/subcategory/{id}','SubCategoryController@subcat_approve')->name('subcategory.approve');
// Product Routes
Route::resource('product','ProductController');
