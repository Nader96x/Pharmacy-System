<?php

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/pharmacies')->group(function () {
        Route::get('/{post}', [\App\Http\Controllers\PharmacyController::class, 'index']);
        Route::get('/{post}', [\App\Http\Controllers\PharmacyController::class, 'show']);
        Route::post('', [\App\Http\Controllers\PharmacyController::class, 'store']);
        Route::put('/{post}', [\App\Http\Controllers\PharmacyController::class, 'update']);
        Route::delete('/{post}', [\App\Http\Controllers\PharmacyController::class, 'destroy']);
    });
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'name' => 'required',
        'avatar' => 'required',
        'priority' => 'required',
        'area_id' => 'required',
    ]);
});
