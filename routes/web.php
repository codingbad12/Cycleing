<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ShipManagementController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ReportController;

// Main routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Ship routes
Route::get('/ships', [ShipController::class, 'index'])->name('ships.index');
Route::get('/ships/{id}', [ShipController::class, 'show'])->name('ships.show');
Route::post('/ships/{id}', [ShipController::class, 'book'])->name('ships.book');

// User routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    // My Bookings routes
    Route::get('/bookings', [\App\Http\Controllers\User\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [\App\Http\Controllers\User\BookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{id}/return', [\App\Http\Controllers\User\BookingController::class, 'returnShip'])->name('bookings.return');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Admin Routes Group
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Ship Management Routes
    Route::resource('ships', ShipManagementController::class);
    
    // Booking Management Routes
    Route::resource('bookings', BookingController::class)->except(['approve', 'reject', 'confirm-return']);
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{id}/confirm-return', [BookingController::class, 'confirmReturn'])->name('bookings.confirm-return');
    
    // User Management Routes
    Route::resource('users', UserManagementController::class)->except(['create', 'store', 'show']);
    Route::get('/users/{id}/history', [UserManagementController::class, 'rentalHistory'])->name('users.history');
    Route::post('/users/{id}/fine', [UserManagementController::class, 'fine'])->name('users.fine');
    
    // Penalty Management Routes
    Route::resource('penalties', App\Http\Controllers\Admin\PenaltyController::class);
    Route::get('/penalties/calculate', [App\Http\Controllers\Admin\PenaltyController::class, 'calculateLatePenalties'])->name('penalties.calculate');
    
    // Reports & Invoicing Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/invoice/{id}', [ReportController::class, 'invoice'])->name('reports.invoice');
    Route::get('/reports/print-invoice/{id}', [ReportController::class, 'printInvoice'])->name('reports.printInvoice');
}); 

// User routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [App\Http\Controllers\UserProfileController::class, 'showChangePasswordForm'])->name('profile.password');
    Route::post('/profile/password', [App\Http\Controllers\UserProfileController::class, 'changePassword'])->name('profile.password.update');
    
    // Notification routes
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::delete('/notifications/{id}', [App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
});
