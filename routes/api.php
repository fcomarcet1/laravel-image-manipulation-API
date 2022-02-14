<?php

use App\Http\Controllers\V1\AlbumController;
use App\Http\Controllers\V1\ImageManipulationController;
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

// Album routes
Route::prefix('v1')->group(function() {
    # Albums routes
    Route::apiResource('albums', AlbumController::class);
    # Images routes
    Route::get('images', [ImageManipulationController::class, 'index']);
    Route::get('images/album/{id}', [ImageManipulationController::class, 'byAlbum']);
    Route::post('images/resize', [ImageManipulationController::class, 'resize']);
    Route::get('images/{id}', [ImageManipulationController::class, 'show']);
    Route::get('images/{id}', [ImageManipulationController::class, 'destroy']);


});

/*Route::prefix('v1')->group(function() {
    Route::resource('albums', AlbumController::class);
});*/
