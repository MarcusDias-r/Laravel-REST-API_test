<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivitiesController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')->group(function(){
   
    Route::post('activities', [ActivitiesController::class, 'store']);
    Route::post('activities/{activity_id}/items', [ActivitiesController::class, 'storeItems']);

    Route::get('activities',  [ActivitiesController::class, 'show'])->name('api.group');
    Route::get('activities/{activity_id}/items', [ActivitiesController::class, 'getActivityById']);

    Route::patch('activities/{activity_id}', [ActivitiesController::class, 'activityUpdate']);
    Route::patch('activities/{activity_id}/item/{item_id}', [ActivitiesController::class, 'itemUpdate']);

    Route::delete('activities/{activity_id}', [ActivitiesController::class, 'activityDestroy']);
    Route::delete('activities/{activity_id}/item/{item_id}', [ActivitiesController::class, 'itemDestroy']);
});