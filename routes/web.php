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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', $controller_path . '\dashboard\HomeController@index')->name('dashboard.home');

Route::name('admin.')->group(function () use ($controller_path) {

  Route::resource('/categories',$controller_path . '\dashboard\CategoryController');
  Route::resource('/items',$controller_path . '\dashboard\ItemController');
  Route::resource('/users',$controller_path . '\dashboard\ItemController')->only('index');

});
