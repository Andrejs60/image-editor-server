<?php

use App\Http\Controllers\AuthController;
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

// Public routes
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

// Protected routes
// Route::group(["middleware" => ["auth:sanctum"]] ,function () {
    // All Images
    Route::middleware('auth:sanctum')->get("/images", [ImageController::class, "index"]);

    // Single Image
    Route::middleware('auth:sanctum')->get("/images/{image}", [ImageController::class, "show"]);

    // Fetch Image
    Route::middleware('auth:sanctum')->get("/images/{image}/fetch", [ImageController::class, "fetchImage"]);

    // Store Image
    Route::middleware('auth:sanctum')->post("/images", [ImageController::class, "store"]);

    // Logout
    Route::middleware('auth:sanctum')->post("/logout", [AuthController::class, "logout"]);
// });






