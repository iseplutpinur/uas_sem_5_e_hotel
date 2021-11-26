<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminAuthorizationSettingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGroupUserController;
use App\Http\Controllers\AdminRoomCategoryController;
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

    Route::get('/admin/authorization-setting', [AdminAuthorizationSettingController::class, 'index'])->name('admin.authorization-setting');
    Route::post('/admin/authorization-setting', [AdminAuthorizationSettingController::class, 'table']);
    Route::post('/admin/authorization-setting/update', [AdminAuthorizationSettingController::class, 'update'])->name('admin.authorization-setting.update');

    Route::get('/admin/room-category', [AdminRoomCategoryController::class, 'index'])->name('admin.room-category');
    Route::post('/admin/room-category', [AdminRoomCategoryController::class, 'table']);
    Route::get('/admin/room-category/add', [AdminRoomCategoryController::class, 'add'])->name('admin.room-category.add');
    Route::post('/admin/room-category/store', [AdminRoomCategoryController::class, 'store'])->name('admin.room-category.store');
    Route::get('/admin/room-category/edit/{id}', [AdminRoomCategoryController::class, 'edit'])->name('admin.room-category.edit');
    Route::get('/admin/room-category/image/{id}', [AdminRoomCategoryController::class, 'image'])->name('admin.room-category.image');
    Route::post('/admin/room-category/images', [AdminRoomCategoryController::class, 'images'])->name('admin.room-category.images');
    Route::get('/admin/room-category/detail/{id}', [AdminRoomCategoryController::class, 'detail'])->name('admin.room-category.detail');
    Route::delete('/admin/room-category/delete/{id}', [AdminRoomCategoryController::class, 'delete'])->name('admin.room-category.delete');

    Route::get('/admin/room', [])->name('admin.room');

    Route::get('/admin/error-401', function () {
        return view('admin.error-401', [
            'title' => 'Error 401'
        ]);
    })->name('admin.error-401');
});
