<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserChatController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
    Route::post('/resend-otp', [AuthController::class, 'resendOtp']);
    Route::post('/forgot-password/send-otp', [AuthController::class, 'sendResetOtp']);
    Route::post('/forgot-password/verify-otp', [AuthController::class, 'verifyResetOtp']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::patch('/profile', [AuthController::class, 'updateProfile']);

    // Address routes
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::put('/addresses/{id}', [AddressController::class, 'update']);
    Route::delete('/addresses/{id}', [AddressController::class, 'destroy']);
    Route::patch('/addresses/{id}/default', [AddressController::class, 'setDefault']);
});

// Users management routes
Route::get('/users', [AuthController::class, 'getUsers']);
Route::patch('/users/{user}/status', [AuthController::class, 'updateUserStatus']);

// User Chat routes
Route::prefix('user/chat')->group(function () {
    Route::get('/messages', [UserChatController::class, 'getMessages']);
    Route::post('/send', [UserChatController::class, 'send']);
});

// Admin Chat routes
Route::prefix('admin/chat')->group(function () {
    Route::get('/users', [AdminChatController::class, 'getUsers']);
    Route::get('/messages/{userId}', [AdminChatController::class, 'getMessages']);
    Route::post('/send', [AdminChatController::class, 'send']);
    Route::get('/unread-count', [AdminChatController::class, 'getUnreadCount']);
    Route::get('/search-customers', [AdminChatController::class, 'searchCustomers']);
    Route::get('/user-detail/{userId}', [AdminChatController::class, 'getUserDetail']);
    Route::post('/mark-as-read/{userId}', [AdminChatController::class, 'markAsRead']);
});
