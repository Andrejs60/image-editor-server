<?php

use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// All Images
Route::get("/images", [ImageController::class, "index"]);

// Single Image
Route::get("/images/{image}", [ImageController::class, "show"]);

// Fetch Image
Route::get("/images/{image}/fetch", [ImageController::class, "fetchImage"]);

// Store Image
Route::post("/images", [ImageController::class, "store"]);



