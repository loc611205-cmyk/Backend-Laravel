<?php

use App\Http\Controllers\CategoriesControllers;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodsControllers;
use App\Http\Controllers\ProductsController;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/health', function(){
    return response()->json(['status' => 'OK',
    'message' => 'API is hoạt động']);
});

Route::middleware('')->group(function () {

    Route::get('/foods', [FoodController::class, 'index']);
    Route::get('/foods/{id}', [FoodController::class, 'show']);
    Route::put('/foods/{id}', [FoodController::class, 'update']);
    Route::delete('/foods/{id}', [FoodController::class, 'destroy']);

});

Route::middleware('')->group(function(){
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{id}', [ProductsController::class, 'show']);
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{id}', [ProductsController::class, 'update']);
    Route::patch('/products/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'destroy']);
});

Route::prefix('/category')->group(function () {
    Route::get('/', [CategoriesControllers::class, 'index']);
    Route::get('/{id}', [CategoriesControllers::class, 'show']);
    Route::post('/', [CategoriesControllers::class, 'create']);
    Route::put('/{id}', [CategoriesControllers::class, 'update']);
    Route::delete('/{id}', [CategoriesControllers::class, 'delete']);
});


Route::prefix('/food')->group(function () {
    Route::get('/', [FoodsControllers::class, 'index']);
    Route::get('/{id}', [FoodsControllers::class, 'show']);
    Route::post('/', [FoodsControllers::class, 'create']);
    Route::put('/{id}', [FoodsControllers::class, 'update']);
    Route::delete('/{id}', [FoodsControllers::class, 'delete']);
});
