<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\AgentApplicationController;
use App\Http\Controllers\AdminController;

Route::get('/', [WelcomeController::class, 'index']);

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Agent Routes
Route::middleware(['auth', 'approved.agent'])->prefix('agent')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');

    // Chats
    Route::prefix('chats')->group(function () {
        Route::get('/{chat}', [ChatController::class, 'show'])->name('agent.chat.show');
        Route::post('/{chat}/message', [ChatController::class, 'storeMessage'])->name('agent.chat.message.store');
        Route::post('/{chat}/close', [ChatController::class, 'closeDeal'])->name('agent.chat.close');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Properties
    Route::resource('properties', PropertyController::class)
        ->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
    
    // Agent routes
    Route::middleware('approved.agent')->group(function () {
        Route::get('/agent/dashboard', [AgentController::class, 'dashboard']);
        Route::get('/agent/properties', [PropertyController::class, 'agentProperties'])
            ->name('agent.properties');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Chat routes
    Route::prefix('chats')->group(function () {
        Route::get('/{chat}', [ChatController::class, 'show'])->name('chats.show');
        Route::post('/{chat}/messages', [ChatController::class, 'storeMessage'])->name('chats.messages.store');
        Route::post('/{chat}/close', [ChatController::class, 'closeDeal'])->name('chats.close');
    });
});

Route::middleware(['auth', 'verified', 'chat.participant'])->group(function () {
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show');
});

// routes/web.php

// Customer Routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/apply-agent', [AgentApplicationController::class, 'create'])->name('agent.apply');
    Route::post('/apply-agent', [AgentApplicationController::class, 'store'])->name('agent.apply.store');
});

// Agent Routes
Route::middleware(['auth', 'approved.agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentDashboardController::class, 'index'])->name('agent.dashboard');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/approve-agent/{user}', [AdminController::class, 'approveAgent'])->name('admin.agent.approve');
    Route::post('/reject-agent/{user}', [AdminController::class, 'rejectAgent'])->name('admin.agent.reject');
});

require __DIR__.'/auth.php';
