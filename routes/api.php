<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BoxItemController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
  Route::post('/register', 'register');
  Route::post('/login', 'login');
  Route::post('/forget_password', 'forgetPassword');
  Route::post('/forget_confirm_code', 'forgetConfirmCode');
  Route::post('/reset_password', 'resetPassword');
  Route::post('/logout', 'logout')->middleware('auth:sanctum');
  Route::get('/profile', 'profile')->middleware('auth:sanctum');
});


Route::controller(CategoryController::class)->group(function(){
  Route::get('/all-categories', 'allCategories')->middleware('auth:sanctum');
});



Route::controller(ItemController::class)->group(function(){
  Route::get('/all-items', 'allItems')->middleware('auth:sanctum');
  Route::get('/show/{id}', 'show')->middleware('auth:sanctum');

});


Route::controller(BoxItemController::class)->group(function(){
  Route::get('/all-boxes', 'allBoxes')->middleware('auth:sanctum');
  Route::get('/show/{id}', 'show')->middleware('auth:sanctum');

});
Route::controller(CartController::class)->group(function(){
  Route::post('/add-item-to-cart', 'addItemToCart')->middleware('auth:sanctum');
  Route::post('/remove-item-from-cart', 'removeItemFromCart')->middleware('auth:sanctum');
  Route::post('/update-item-quantity-from-cart', '  updateItemQuantityFromCart')->middleware('auth:sanctum');
  Route::get('/cart-count', 'count')->middleware('auth:sanctum');
  Route::get('/view-cart', 'viewCart')->middleware('auth:sanctum');
  Route::post('/destroy-cart', 'destroyCart')->middleware('auth:sanctum');

});


