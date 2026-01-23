<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\PayrollLetterController;
use App\Http\Controllers\JobNotificationLetterController;
use App\Http\Controllers\WaterAvailabilityLetterController;
use App\Http\Controllers\RecommendationLetterController;
use App\Http\Controllers\TaskOrderLetterController;
use App\Http\Controllers\DelegationLetterController;
use App\Http\Controllers\InternalTransferLetterController;
use App\Http\Controllers\InternshipPermissionLetterController;

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

// Profile Routes (Available for all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Surat Keluar Routes
Route::middleware(['auth'])->group(function () {
    Route::resource('surat-keluar', SuratKeluarController::class);
    
    // Template Surat Routes
    Route::resource('payroll-letters', PayrollLetterController::class);
    Route::resource('job-notification-letters', JobNotificationLetterController::class);
    Route::resource('water-availability-letters', WaterAvailabilityLetterController::class);
    Route::resource('recommendation-letters', RecommendationLetterController::class);
    Route::resource('task-order-letters', TaskOrderLetterController::class);
    Route::resource('delegation-letters', DelegationLetterController::class);
    Route::resource('internal-transfer-letters', InternalTransferLetterController::class);
    Route::resource('internship-permission-letters', InternshipPermissionLetterController::class);
});

// Fitur Tambahan Routes - DIHAPUS (gunakan template letters route yang sudah ada di atas)

// Admin Routes
Route::middleware(['auth', 'role:manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User Management Routes
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');
    Route::post('/user-management', [UserManagementController::class, 'store'])->name('user-management.store');
    Route::put('/user-management/{user}', [UserManagementController::class, 'update'])->name('user-management.update');
    Route::delete('/user-management/{user}', [UserManagementController::class, 'destroy'])->name('user-management.destroy');
    Route::patch('/user-management/{user}/role', [UserManagementController::class, 'updateRole'])->name('user-management.update-role');
    Route::post('/user-management/toggle-registration', [UserManagementController::class, 'toggleRegistration'])->name('user-management.toggle-registration');
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

