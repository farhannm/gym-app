<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('promifile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'userMiddleware'])->group(function(){
    Route::get('/dashboard', [UsersController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user', [AdminController::class, 'viewUser'])->name('admin.user');
    Route::get('/admin/coach', [AdminController::class, 'viewCoach'])->name('admin.coach');
    Route::get('/admin/classes', [AdminController::class, 'viewClasses'])->name('admin.classes');

    // Form untuk insert user
    Route::get('/admin/create_user', [AdminController::class, 'createUserForm'])->name('admin.create_user');

    // Insert user
    Route::post('/admin/insert_user', [AdminController::class, 'store'])->name('admin.insert_user');

    // Delete user
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.delete_user');
});
