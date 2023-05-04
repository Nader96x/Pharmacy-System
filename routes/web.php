<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
//})->middleware(['auth', 'verified']);
})->middleware(['auth', 'verified', 'role:admin|owner|doctor']);

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('/areas')->group(function () {
        Route::get('/', [AreaController::class, 'index'])->name('areas.index');
        Route::get('/create', [AreaController::class, 'create'])->name('areas.create');
        Route::post('/', [AreaController::class, 'store'])->name('areas.store');
        Route::get('{area}/edit', [AreaController::class, 'edit'])->name('areas.edit');
        Route::put('/{area}', [AreaController::class, 'update'])->name('areas.update');
        Route::delete('/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');
    });
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
Route::group(['middleware' => ['role:admin|owner|doctor']], function () {
    Route::prefix('/medicines')->group(function () {
        Route::get('/', [MedicineController::class, 'index'])->name('medicines.index');
        Route::get('/create', [MedicineController::class, 'create'])->name('medicines.create');
        Route::post('/', [MedicineController::class, 'store'])->name('medicines.store');
        Route::delete('/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');
        Route::get('/{id}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
        Route::put('/{id}', [MedicineController::class, 'update'])->name('medicines.update');
        Route::get('/{id}', [MedicineController::class, 'show'])->name('medicines.show');
    });
});
Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('/addresses')->group(function () {
        Route::get('/', [UserAddressController::class, 'index'])->name('addresses.index');
        Route::delete('/{address}', [UserAddressController::class, 'destroy'])->name('addresses.destroy');
    });
});

Route::group(['middleware' => ['role:admin|owner|doctor']], function () {
    Route::prefix('/pharmacy')->group(function () {
        Route::get('/', [PharmacyController::class, 'index'])->name('pharmacies.index');
        Route::get('/create', [PharmacyController::class, 'create'])->name('pharmacies.create');
        Route::post('/', [PharmacyController::class, 'store'])->name('pharmacies.store');
        Route::get('{pharmacy}/edit', [PharmacyController::class, 'edit'])->name('pharmacies.edit');
        Route::put('/{pharmacy}', [PharmacyController::class, 'update'])->name('pharmacies.update');
        Route::delete('/{pharmacy}', [PharmacyController::class, 'destroy'])->name('pharmacies.destroy');
        Route::post('/pharmacies/{pharmacy}/restore', [PharmacyController::class, 'restore'])->name('pharmacies.restore');
    });
});

Route::prefix('/doctors')->group(function () {
    Route::get('/', [\App\Http\Controllers\DoctorController::class, 'index'])->name('doctors.index');
    Route::delete('/{id}', [\App\Http\Controllers\DoctorController::class, 'destroy'])->name('doctors.destroy');
    Route::get('/create', [\App\Http\Controllers\DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/', [\App\Http\Controllers\DoctorController::class, 'store'])->name('doctors.store');

    Route::get('/{id}/edit', [\App\Http\Controllers\DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/{id}', [\App\Http\Controllers\DoctorController::class, 'update'])->name('doctors.update');
    Route::put('/{id}/ban', [\App\Http\Controllers\DoctorController::class, 'ban'])->name('doctors.ban');
    Route::put('/{id}/unban', [\App\Http\Controllers\DoctorController::class, 'unban'])->name('doctors.unban');
});
Route::prefix('owners/')->group(function () {
    Route::get('/', [\App\Http\Controllers\OwnerController::class, 'index'])->name('owners.index');
    Route::delete('/{id}', [\App\Http\Controllers\OwnerController::class, 'destroy'])->name('owners.destroy');
    Route::get('/create', [\App\Http\Controllers\OwnerController::class, 'create'])->name('owners.create');
    Route::post('/', [\App\Http\Controllers\OwnerController::class, 'store'])->name('owners.store');
    Route::get('/{id}/edit', [\App\Http\Controllers\OwnerController::class, 'edit'])->name('owners.edit');
    Route::put('/{id}', [\App\Http\Controllers\OwnerController::class, 'update'])->name('owners.update');
    Route::put('/{id}/ban', [\App\Http\Controllers\OwnerController::class, 'ban'])->name('owners.ban');
    Route::put('/{id}/unban', [\App\Http\Controllers\OwnerController::class, 'unban'])->name('owners.unban');
});

Route::prefix('/orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/{id}', [OrderController::class, 'update'])->name('orders.update');

});

Auth::routes(['register' => false]);

Route::group([], function () {
    Route::prefix('/stripe')->group(function () {
        Route::get('/', [\App\Http\Controllers\StripeController::class, 'stripe'])->name('stripe');
        Route::post('/', [\App\Http\Controllers\StripeController::class, 'stripePost'])->name('stripe.post');
    });
});
