<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Placeholder routes for buttons
        Route::get('users', [DashboardController::class, 'users'])->name('users.index');
        Route::delete('users/{user}', [DashboardController::class, 'destroyUser'])->name('users.destroy');
        Route::post('users/{user}/toggle-block', [DashboardController::class, 'toggleBlock'])->name('users.toggle-block');
        Route::post('users/{user}/update-balance', [DashboardController::class, 'updateBalance'])->name('users.update-balance');
        Route::post('users/{user}/fund', [DashboardController::class, 'fundAccount'])->name('users.fund');
        Route::get('tools/create', [DashboardController::class, 'createTool'])->name('tools.create');
    });
});
