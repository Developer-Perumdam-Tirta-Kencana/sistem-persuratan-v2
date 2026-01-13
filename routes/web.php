<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Dashboard Routes - Redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->hasRole('manager')) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->hasRole('staff')) {
        return redirect()->route('staff.dashboard');
    } elseif ($user->hasRole('direksi')) {
        return redirect()->route('direksi.dashboard');
    } elseif ($user->hasRole('kepala_divisi')) {
        return redirect()->route('kepala-divisi.dashboard');
    } else {
        return redirect()->route('user.dashboard');
    }
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/user-management', [AdminDashboardController::class, 'userManagement'])->name('user-management');
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/dashboard', [StaffDashboardController::class, 'index'])->name('dashboard');
});

// Direksi Routes
Route::middleware(['auth', 'role:direksi'])->prefix('direksi')->name('direksi.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

// Kepala Divisi Routes
Route::middleware(['auth', 'role:kepala_divisi'])->prefix('kepala-divisi')->name('kepala-divisi.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

// Fallback user route (optional)
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';

