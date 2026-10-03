<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/message', [HomeController::class, 'storeMessage'])->name('message.store');
Route::get('/cv', [HomeController::class, 'viewCv'])->name('cv.show');
Route::get('/cv/unduh', [HomeController::class, 'downloadCv'])->name('cv.download');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // To be created
    })->name('dashboard');

    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class)->except(['show']);
    Route::resource('skills', \App\Http\Controllers\Admin\SkillController::class)->except(['show']);
    Route::resource('achievements', \App\Http\Controllers\Admin\AchievementController::class)->except(['show']);
    
    Route::resource('artworks', \App\Http\Controllers\Admin\ArtworkController::class)->except(['show']);
    Route::post('artworks/reorder', [\App\Http\Controllers\Admin\ArtworkController::class, 'reorder'])->name('artworks.reorder');
    
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('messages/{message}/read', [\App\Http\Controllers\Admin\MessageController::class, 'markAsRead'])->name('messages.read');
    
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

