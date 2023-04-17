<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::prefix('/pharmacy')->group(function () {
    Route::get('/', [\App\Http\Controllers\PharmacyController::class, 'index'])->name('pharmacies.index');
    Route::get('/create', [\App\Http\Controllers\PharmacyController::class, 'create'])->name('pharmacies.create');
    Route::post('/', [\App\Http\Controllers\PharmacyController::class, 'store'])->name('pharmacies.store');
    Route::get('{pharmacy}/edit', [\App\Http\Controllers\PharmacyController::class,'edit'])->name('pharmacies.edit');
    Route::put('/{pharmacy}', [\App\Http\Controllers\PharmacyController::class, 'update'])->name('pharmacies.update');
    Route::delete('/{pharmacy}', [\App\Http\Controllers\PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
    Route::post('/pharmacies/{pharmacy}/restore', [\App\Http\Controllers\PharmacyController::class, 'restore'])->name('pharmacies.restore');
});
