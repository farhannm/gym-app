<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\UsersController;
use App\Models\Classes;

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
    Route::get('/schedule_class', [UsersController::class, 'viewReservation'])->name('schedule_class');
    Route::get('/coach', [UsersController::class, 'viewCoach'])->name('coach');
    Route::get('/equipments', [UsersController::class, 'viewEquipments'])->name('equipments');
    Route::get('/schedule_class/search', [ClassesController::class, 'search'])->name('classes.search');

    //Class
    Route::get('/make_reservation', [ReservationsController::class, 'createReservationForm'])->name('create_reservation');
    Route::post('/insert_reservation', [ReservationsController::class, 'create'])->name('insert.reservation');

    //Payment
    Route::put('/schedule_class/{id}', [ReservationsController::class, 'update'])->name('update.payment.status');
    
});

Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user', [AdminController::class, 'viewUser'])->name('admin.user');
    Route::get('/admin/coach', [AdminController::class, 'viewCoach'])->name('admin.coach');
    Route::get('/admin/classes', [AdminController::class, 'viewClasses'])->name('admin.classes');
    Route::get('/admin/payment', [AdminController::class, 'viewPayment'])->name('admin.payment');

    //User
    Route::get('/admin/create_user', [AdminController::class, 'createUserForm'])->name('admin.create_user');
    Route::post('/admin/insert_user', [AdminController::class, 'store'])->name('admin.insert_user');
    Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('admin.delete_user');
    Route::get('/admin/update_user/{id}', [AdminController::class, 'updateUser'])->name('admin.view_update_user');
    Route::put('/admin/update_user/{id}', [AdminController::class, 'updateDataUser'])->name('admin.update_user');

    //Coach
    Route::get('/admin/create_coach', [AdminController::class, 'createCoachForm'])->name('admin.create_coach');
    Route::post('/admin/insert_coach', [AdminController::class, 'storeCoach'])->name('admin.insert_coach');
    Route::delete('/admin/coach/{id}', [AdminController::class, 'destroyCoach'])->name('admin.delete_coach');
    Route::get('/admin/update_coach/{id}', [AdminController::class, 'updateCoach'])->name('admin.view_update_coach');
    Route::put('/admin/update_coach/{id}', [AdminController::class, 'updateDataCoach'])->name('admin.update_coach');

    //Class
    Route::get('/admin/create_class', [ClassesController::class, 'createClassForm'])->name('admin.create_class');
    Route::get('/admin/create_class', [ClassesController::class, 'viewTrainer'])->name('admin.create_class');
    Route::post('/admin/insert_class', [ClassesController::class, 'create'])->name('admin.insert_class');
    Route::delete('/admin/classes/{id}', [ClassesController::class, 'destroyClass'])->name('admin.delete_class');
    Route::get('/admin/update_class/{id}', [ClassesController::class, 'updateClass'])->name('admin.view_update_class');
    Route::put('/admin/update_class/{id}', [ClassesController::class, 'updateDataClass'])->name('admin.update_class');

    //Payment
    Route::put('/admin/payment/{id}', [ReservationsController::class, 'updatePaymentAdmin'])->name('update.payment_admin.status');
    Route::delete('/admin/payment/{id}', [ReservationsController::class, 'destroy'])->name('delete.reservation');
});

