<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BoxItemController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\WarehouseController;
use App\Models\Warehouse;
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
  Route::post('/verify_otp', 'verifyOtp');
  Route::post('/send-otp-again','sendOtpAgain');
  Route::post('/forget_password', 'forgetPassword');
  Route::post('/forget_confirm_code', 'forgetConfirmCode');
  Route::post('/reset_password', 'resetPassword');
  Route::post('/logout', 'logout')->middleware('auth:sanctum');
  Route::get('/profile', 'profile')->middleware('auth:sanctum');
  Route::post('/update-profile', 'updateProfile')->middleware('auth:sanctum');
  Route::get('/my-orders', 'orders')->middleware('auth:sanctum');
});


Route::middleware('app-language')->controller(CategoryController::class)->group(function(){
  Route::get('/all-categories', 'allCategories')->middleware('auth:sanctum');
});



Route::middleware('app-language')->controller(ItemController::class)->group(function(){
  Route::get('/all-items', 'allItems')->middleware('auth:sanctum');
  Route::get('/items/{id}/show', 'show')->middleware('auth:sanctum');

});


Route::middleware('app-language')->controller(BoxItemController::class)->group(function(){
  Route::get('/all-boxes', 'allBoxes')->middleware('auth:sanctum');
  Route::get('/boxes/{id}/show', 'show')->middleware('auth:sanctum');

});
Route::controller(CartController::class)->group(function(){
  Route::post('/add-item-to-cart', 'addItemToCart')->middleware('auth:sanctum');
  Route::post('/remove-item-from-cart', 'removeItemFromCart')->middleware('auth:sanctum');
  Route::post('/update-item-quantity-from-cart', 'updateItemQuantityFromCart')->middleware('auth:sanctum');
  Route::get('/cart-count', 'count')->middleware('auth:sanctum');
  Route::get('/view-cart', 'viewCart')->middleware('auth:sanctum');
  Route::get('/destroy-cart/{id}', 'destroy')->middleware('auth:sanctum');

});

Route::middleware('app-language')->controller(FavoriteController::class)->group(function(){
  Route::post('/add-to-favorite/{id}','addToFavorite')->middleware('auth:sanctum');
  Route::get('/all-favoritelist','allFavotriteList')->middleware('auth:sanctum');
});


Route::middleware('app-language')->controller(WarehouseController::class)->group(function(){
  Route::get('/all-warehouses', 'allWarehouses')->middleware('auth:sanctum');
});


Route::middleware('app-language')->controller(OrderController::class)->group(function(){
  Route::post('/store-order','store')->middleware('auth:sanctum');
});
