<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

// Halaman utama diarahkan ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Semua route yang butuh login
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (menampilkan daftar tugas)
    Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');

    // Halaman tambah tugas
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

    // Simpan tugas baru
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Ubah status tugas (selesai / belum)
    Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');

    // Hapus tugas
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route bawaan Breeze (login, register, dsb.)
require __DIR__ . '/auth.php';
