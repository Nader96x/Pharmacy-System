<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;

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

Route::prefix('/areas')->group(function () {
    Route::get('/', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/create', [AreaController::class ,'create'])->name('areas.create');
    Route::post('/', [AreaController::class, 'store'])->name('areas.store');
    Route::get('/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

});
