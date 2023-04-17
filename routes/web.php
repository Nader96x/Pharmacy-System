<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserAddressController;
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

Route::prefix('/areas')->group(function () {
    Route::get('/', [AreaController::class, 'index'])->name('areas.index');
    Route::get('/create', [AreaController::class, 'create'])->name('areas.create');
    Route::post('/', [AreaController::class, 'store'])->name('areas.store');
    Route::get('{area}/edit', [AreaController::class,'edit'])->name('areas.edit');
    Route::put('/{area}', [AreaController::class, 'update'])->name('areas.update');
    Route::delete('/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');
});
Route::prefix('/medicines')->group(function () {
    Route::get('/', [MedicineController::class, 'index'])->name('medicines.index');
    Route::get('/create', [MedicineController::class, 'create'])->name('medicines.create');
    Route::post('/', [MedicineController::class, 'store'])->name('medicines.store');
    Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
    Route::get('/{id}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
    Route::put('/{id}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::get('/{id}', [MedicineController::class, 'show'])->name('medicines.show');
});
Route::prefix('/addresses')->group(function () {
    Route::get('/', [UserAddressController::class, 'index'])->name('addresses.index');
    Route::delete('/{address}', [UserAddressController::class, 'destroy'])->name('addresses.destroy');
});



