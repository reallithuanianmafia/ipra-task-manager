<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ActivityLogController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return new RedirectResponse(route('dashboard'));
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/api/tasks-and-bugs', [TaskController::class, 'index']);
    Route::post('/api/tasks-and-bugs', [TaskController::class, 'store']);
    Route::get('/api/tasks-and-bugs/{id}', [TaskController::class, 'show']);
    Route::delete('/api/tasks-and-bugs/{id}', [TaskController::class, 'destroy']);
    Route::put('/api/tasks/{id}', [TaskController::class, 'update']);

    Route::get('/api/users', [UserController::class, 'index']);

    Route::get('/dashboard/tasks-and-bugs/{id}', [TaskController::class, 'show']);

    Route::get('/api/comments', [CommentController::class, 'index']);
    Route::post('/api/comments', [CommentController::class, 'store']);
    Route::get('/api/comments/{id}', [CommentController::class, 'show']);
    Route::put('/api/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/api/comments/{id}', [CommentController::class, 'destroy']);

    Route::get('/dashboard/activity-logs', [ActivityLogController::class, 'index'])->name('activity_logs');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
