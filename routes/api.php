<?php

use App\Http\Controllers\Api\UserAddressController;
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


Route::prefix('/addresses')->group(function () {
    Route::get('/', [UserAddressController::class, 'index'])->name('addresses.index');
    Route::post('/', [UserAddressController::class, 'store'])->name('addresses.store');
    Route::get('{address}', [UserAddressController::class,'show'])->name('addresses.show');
    Route::put('/{address}', [UserAddressController::class, 'update'])->name('addresses.update');
    Route::delete('/{address}', [UserAddressController::class, 'destroy'])->name('addresses.destroy');
});
