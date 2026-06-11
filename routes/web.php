<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\AdminKabupatentController;
use App\Http\Controllers\StableController;
use App\Http\Controllers\UserController;
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

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // SuperAdmin Routes
    Route::middleware('role:SuperAdmin')->group(function () {
        Route::resource('kabupaten', KabupatenController::class);
        
        // Stable Routes (define specific routes BEFORE resource)
        Route::get('/stable/get-kabupaten', [StableController::class, 'getKabupaten'])->name('stable.get-kabupaten');
        Route::get('/stable/kabupaten/{kabupatanId}', [StableController::class, 'getByKabupaten'])->name('stable.by-kabupaten');
        Route::resource('stable', StableController::class);
        
        // Atlet CRUD under stable
        Route::post('/stable/{stable}/atlet', [StableController::class, 'storeAtlet'])->name('stable.atlet.store');
        Route::put('/stable/{stable}/atlet/{atlet}', [StableController::class, 'updateAtlet'])->name('stable.atlet.update');
        Route::delete('/stable/{stable}/atlet/{atlet}', [StableController::class, 'destroyAtlet'])->name('stable.atlet.destroy');
        
        // Kuda CRUD under stable
        Route::post('/stable/{stable}/kuda', [StableController::class, 'storeKuda'])->name('stable.kuda.store');
        Route::put('/stable/{stable}/kuda/{kuda}', [StableController::class, 'updateKuda'])->name('stable.kuda.update');
        Route::delete('/stable/{stable}/kuda/{kuda}', [StableController::class, 'destroyKuda'])->name('stable.kuda.destroy');
        
        // Pelatih CRUD under stable
        Route::get('/stable/{stable}/pelatih/users', [StableController::class, 'getPelatihUsers'])->name('stable.pelatih.users');
        Route::post('/stable/{stable}/pelatih', [StableController::class, 'storePelatih'])->name('stable.pelatih.store');
        Route::put('/stable/{stable}/pelatih/{user}', [StableController::class, 'updatePelatih'])->name('stable.pelatih.update');
        Route::delete('/stable/{stable}/pelatih/{user}', [StableController::class, 'destroyPelatih'])->name('stable.pelatih.destroy');
        
        // Pengguna (User Management)
        Route::resource('pengguna', UserController::class)->only(['index', 'store', 'update', 'destroy']);

        // Admin Kabupaten Management (nested under kabupaten)
        Route::get('/kabupaten/{kabupatanId}/admin/get-users', [AdminKabupatentController::class, 'getUsers'])->name('admin-kabupaten.get-users');
        Route::post('/kabupaten/{kabupatanId}/admin', [AdminKabupatentController::class, 'store'])->name('admin-kabupaten.store');
        Route::get('/kabupaten/{kabupatanId}/admin/{userId}', [AdminKabupatentController::class, 'getAdmin'])->name('admin-kabupaten.get');
        Route::patch('/kabupaten/{kabupatanId}/admin/{userId}', [AdminKabupatentController::class, 'update'])->name('admin-kabupaten.update');
        Route::delete('/kabupaten/{kabupatanId}/admin/{userId}', [AdminKabupatentController::class, 'destroy'])->name('admin-kabupaten.destroy');
    });
});

require __DIR__.'/auth.php';
