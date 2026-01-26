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
    Route::get('payroll-letters/{payrollLetter}/export-pdf', [PayrollLetterController::class, 'exportPdf'])->name('payroll-letters.exportPdf');
    Route::get('payroll-letters/{payrollLetter}/preview-format', [PayrollLetterController::class, 'previewFormat'])->name('payroll-letters.previewFormat');
    Route::get('payroll-letters/{payrollLetter}/export-docx', [PayrollLetterController::class, 'exportDocx'])->name('payroll-letters.exportDocx');
    Route::post('payroll-letters/{payrollLetter}/approve', [PayrollLetterController::class, 'approveAction'])->name('payroll-letters.approveAction');
    Route::post('payroll-letters/{payrollLetter}/reject', [PayrollLetterController::class, 'rejectAction'])->name('payroll-letters.rejectAction');
    
    Route::resource('job-notification-letters', JobNotificationLetterController::class);
    Route::get('job-notification-letters/{jobNotificationLetter}/export-pdf', [JobNotificationLetterController::class, 'exportPdf'])->name('job-notification-letters.exportPdf');
    Route::get('job-notification-letters/{jobNotificationLetter}/preview-format', [JobNotificationLetterController::class, 'previewFormat'])->name('job-notification-letters.previewFormat');
    Route::get('job-notification-letters/{jobNotificationLetter}/export-docx', [JobNotificationLetterController::class, 'exportDocx'])->name('job-notification-letters.exportDocx');
    Route::post('job-notification-letters/{jobNotificationLetter}/approve', [JobNotificationLetterController::class, 'approveAction'])->name('job-notification-letters.approveAction');
    Route::post('job-notification-letters/{jobNotificationLetter}/reject', [JobNotificationLetterController::class, 'rejectAction'])->name('job-notification-letters.rejectAction');
    
    Route::resource('water-availability-letters', WaterAvailabilityLetterController::class);
    Route::get('water-availability-letters/{waterAvailabilityLetter}/export-pdf', [WaterAvailabilityLetterController::class, 'exportPdf'])->name('water-availability-letters.exportPdf');
    Route::get('water-availability-letters/{waterAvailabilityLetter}/preview-format', [WaterAvailabilityLetterController::class, 'previewFormat'])->name('water-availability-letters.previewFormat');
    Route::get('water-availability-letters/{waterAvailabilityLetter}/export-docx', [WaterAvailabilityLetterController::class, 'exportDocx'])->name('water-availability-letters.exportDocx');
    Route::post('water-availability-letters/{waterAvailabilityLetter}/approve', [WaterAvailabilityLetterController::class, 'approveAction'])->name('water-availability-letters.approveAction');
    Route::post('water-availability-letters/{waterAvailabilityLetter}/reject', [WaterAvailabilityLetterController::class, 'rejectAction'])->name('water-availability-letters.rejectAction');
    
    Route::resource('recommendation-letters', RecommendationLetterController::class);
    Route::get('recommendation-letters/{recommendationLetter}/export-pdf', [RecommendationLetterController::class, 'exportPdf'])->name('recommendation-letters.exportPdf');
    Route::get('recommendation-letters/{recommendationLetter}/preview-format', [RecommendationLetterController::class, 'previewFormat'])->name('recommendation-letters.previewFormat');
    Route::get('recommendation-letters/{recommendationLetter}/export-docx', [RecommendationLetterController::class, 'exportDocx'])->name('recommendation-letters.exportDocx');
    Route::post('recommendation-letters/{recommendationLetter}/approve', [RecommendationLetterController::class, 'approveAction'])->name('recommendation-letters.approveAction');
    Route::post('recommendation-letters/{recommendationLetter}/reject', [RecommendationLetterController::class, 'rejectAction'])->name('recommendation-letters.rejectAction');
    
    Route::resource('task-order-letters', TaskOrderLetterController::class);
    Route::get('task-order-letters/{taskOrderLetter}/export-pdf', [TaskOrderLetterController::class, 'exportPdf'])->name('task-order-letters.exportPdf');
    Route::get('task-order-letters/{taskOrderLetter}/preview-format', [TaskOrderLetterController::class, 'previewFormat'])->name('task-order-letters.previewFormat');
    Route::get('task-order-letters/{taskOrderLetter}/export-docx', [TaskOrderLetterController::class, 'exportDocx'])->name('task-order-letters.exportDocx');
    Route::post('task-order-letters/{taskOrderLetter}/approve', [TaskOrderLetterController::class, 'approveAction'])->name('task-order-letters.approveAction');
    Route::post('task-order-letters/{taskOrderLetter}/reject', [TaskOrderLetterController::class, 'rejectAction'])->name('task-order-letters.rejectAction');
    
    Route::resource('delegation-letters', DelegationLetterController::class);
    Route::get('delegation-letters/{delegationLetter}/export-pdf', [DelegationLetterController::class, 'exportPdf'])->name('delegation-letters.exportPdf');
    Route::get('delegation-letters/{delegationLetter}/preview-format', [DelegationLetterController::class, 'previewFormat'])->name('delegation-letters.previewFormat');
    Route::get('delegation-letters/{delegationLetter}/export-docx', [DelegationLetterController::class, 'exportDocx'])->name('delegation-letters.exportDocx');
    Route::post('delegation-letters/{delegationLetter}/approve', [DelegationLetterController::class, 'approveAction'])->name('delegation-letters.approveAction');
    Route::post('delegation-letters/{delegationLetter}/reject', [DelegationLetterController::class, 'rejectAction'])->name('delegation-letters.rejectAction');
    
    Route::resource('internal-transfer-letters', InternalTransferLetterController::class);
    Route::get('internal-transfer-letters/{internalTransferLetter}/export-pdf', [InternalTransferLetterController::class, 'exportPdf'])->name('internal-transfer-letters.exportPdf');
    Route::get('internal-transfer-letters/{internalTransferLetter}/preview-format', [InternalTransferLetterController::class, 'previewFormat'])->name('internal-transfer-letters.previewFormat');
    Route::get('internal-transfer-letters/{internalTransferLetter}/export-docx', [InternalTransferLetterController::class, 'exportDocx'])->name('internal-transfer-letters.exportDocx');
    Route::post('internal-transfer-letters/{internalTransferLetter}/approve', [InternalTransferLetterController::class, 'approveAction'])->name('internal-transfer-letters.approveAction');
    Route::post('internal-transfer-letters/{internalTransferLetter}/reject', [InternalTransferLetterController::class, 'rejectAction'])->name('internal-transfer-letters.rejectAction');
    
    Route::resource('internship-permission-letters', InternshipPermissionLetterController::class);
    Route::get('internship-permission-letters/{internshipPermissionLetter}/export-pdf', [InternshipPermissionLetterController::class, 'exportPdf'])->name('internship-permission-letters.exportPdf');
    Route::get('internship-permission-letters/{internshipPermissionLetter}/preview-format', [InternshipPermissionLetterController::class, 'previewFormat'])->name('internship-permission-letters.previewFormat');
    Route::get('internship-permission-letters/{internshipPermissionLetter}/export-docx', [InternshipPermissionLetterController::class, 'exportDocx'])->name('internship-permission-letters.exportDocx');
    Route::post('internship-permission-letters/{internshipPermissionLetter}/approve', [InternshipPermissionLetterController::class, 'approveAction'])->name('internship-permission-letters.approveAction');
    Route::post('internship-permission-letters/{internshipPermissionLetter}/reject', [InternshipPermissionLetterController::class, 'rejectAction'])->name('internship-permission-letters.rejectAction');
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

