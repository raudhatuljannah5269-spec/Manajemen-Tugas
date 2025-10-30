<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/download', [ReportController::class, 'download'])->name('report.download');
});

require __DIR__ . '/auth.php';
