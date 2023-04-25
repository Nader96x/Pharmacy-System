<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\MedicineController;

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

Route::prefix('/doctors')->group(function () {
    Route::get('/', [\App\Http\Controllers\DoctorController::class, 'index'])->name('doctors.index');
    Route::delete('/{id}', [\App\Http\Controllers\DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/create', [\App\Http\Controllers\DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/', [\App\Http\Controllers\DoctorController::class, 'store'])->name('doctors.store');

    Route::get('/{id}/edit', [\App\Http\Controllers\DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/{id}', [\App\Http\Controllers\DoctorController::class, 'update'])->name('doctors.update');
    Route::put('/{id}/ban',[\App\Http\Controllers\DoctorController::class, 'ban'])->name('doctors.ban');
    Route::put('/{id}/unban',[\App\Http\Controllers\DoctorController::class, 'unban'])->name('doctors.unban');
});
Route::prefix('owners/')->group(function () {
    Route::get('/', [\App\Http\Controllers\OwnerController::class, 'index'])->name('owners.index');
    Route::delete('/{id}', [\App\Http\Controllers\OwnerController::class, 'destroy'])->name('owners.destroy');
    Route::get('/create', [\App\Http\Controllers\OwnerController::class, 'create'])->name('owners.create');
    Route::post('/', [\App\Http\Controllers\OwnerController::class, 'store'])->name('owners.store');
    Route::get('/{id}/edit', [\App\Http\Controllers\OwnerController::class, 'edit'])->name('owners.edit');
    Route::put('/{id}', [\App\Http\Controllers\OwnerController::class, 'update'])->name('owners.update');
    Route::put('/{id}/ban',[\App\Http\Controllers\OwnerController::class, 'ban'])->name('owners.ban');
    Route::put('/{id}/unban',[\App\Http\Controllers\OwnerController::class, 'unban'])->name('owners.unban');
});



