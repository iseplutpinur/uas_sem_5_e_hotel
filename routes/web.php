<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGroupUserController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::middleware(['admin.guest'])->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'authenticate']);
});
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/group-user-admin', [AdminGroupUserController::class, 'index'])->name('admin.group-user-admin');
    Route::post('/admin/group-user-admin', [AdminGroupUserController::class, 'table']);
    Route::get('/admin/group-user-admin/add', [AdminGroupUserController::class, 'add'])->name('admin.group-user-admin.add');
    Route::post('/admin/group-user-admin/store', [AdminGroupUserController::class, 'store'])->name('admin.group-user-admin.store');
    Route::get('/admin/group-user-admin/edit/{id}', [AdminGroupUserController::class, 'edit'])->name('admin.group-user-admin.edit');
    Route::post('/admin/group-user-admin/update', [AdminGroupUserController::class, 'update'])->name('admin.group-user-admin.update');
    Route::delete('/admin/group-user-admin/delete/{id}', [AdminGroupUserController::class, 'delete'])->name('admin.group-user-admin.delete');

    Route::get('/admin/user-admin', [AdminUserController::class, 'index'])->name('admin.user-admin');
    Route::post('/admin/user-admin', [AdminUserController::class, 'table']);
    Route::get('/admin/user-admin/add', [AdminUserController::class, 'add'])->name('admin.user-admin.add');
    Route::get('/admin/user-admin/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user-admin.edit');
    Route::post('/admin/user-admin/store', [AdminUserController::class, 'store'])->name('admin.user-admin.store');
    Route::get('/admin/user-admin/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user-admin.edit');
    Route::post('/admin/user-admin/update', [AdminUserController::class, 'update'])->name('admin.user-admin.update');
    Route::post('/admin/user-admin/update-password', [AdminUserController::class, 'update_password'])->name('admin.user-admin.update-password');
    Route::delete('/admin/user-admin/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user-admin.delete');
});
