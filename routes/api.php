<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Authentication Routes
Route::middleware('throttle:120,1')->prefix("/auth")->group(function() {
    // Un-protected
    Route::post('login', [AuthController::class, 'login']);

    // Protected Routes
    Route::middleware('auth:sanctum')->group(function(){

        // Validate Token Routes
        Route::get('validate', function(Request $request){
            return response()->json([], 200);
        });
        Route::post('validate', function(Request $request){
            return response()->json([], 200);
        });

        Route::get('session', [AuthController::class, 'session']);
        Route::get('logout/{all?}', [AuthController::class, 'logout']);
    });
});