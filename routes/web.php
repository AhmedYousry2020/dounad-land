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

$controller_path = 'App\Http\Controllers\dashboard';

// Main Page Route
Route::get('/dashboard', $controller_path . '\HomeController@index')->name('dashboard.home');

Route::name('dashboard.')->prefix('/dashboard')->group(function () use ($controller_path) {

  Route::get('/login', $controller_path.'\AuthController@LoginForm')->name('loginForm');
  Route::post('/login', $controller_path.'\AuthController@login');
  Route::get('/logout', $controller_path.'\AuthController@logout');

  Route::resource('/categories',$controller_path . '\CategoryController');
  Route::resource('/items',$controller_path . '\ItemController');
  Route::resource('/users',$controller_path . '\ItemController')->only('index');

});
