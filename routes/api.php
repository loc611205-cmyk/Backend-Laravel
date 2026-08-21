<?php

use App\Http\Controllers\FoodController;
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
