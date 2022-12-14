<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\UserController;
use App\Models\News;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/townships', [TownshipController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::resource('/user', UserController::class)->only('index', 'update');
    Route::get('/data', [UserController::class, 'data']);
    
    Route::post('/notification', [NotificationController::class, 'store']);
    Route::get('/notifications/{user_id}', [NotificationController::class, 'notifications']);
    Route::post('/notification-seen/{id}', [NotificationController::class, 'notification_seen']);
    

    Route::resource('/news', NewsController::class);
    Route::resource('/symptom', SymptomController::class);
});