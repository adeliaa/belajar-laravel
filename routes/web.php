<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

// Rute untuk profil Admin
// Route::middleware(['auth', CheckUserRole::class . ':admin'])->group(function () {
//     Route::get('/admin/profile/{id}/edit', [ProfileController::class, 'editAdmin'])->name('admin.edit');
//     Route::post('/admin/profile/{id}', [ProfileController::class, 'updateAdmin'])->name('admin.update');
// });
// Route::match(['get', 'post'], '/profile/user/{id}/{action?}', [ProfileController::class, 'profile'])->name('profileUser')->middleware('role:1,2');

Route::match(['get', 'post'], '/profile/admin/{id}/{action?}', [ProfileController::class, 'adminProfile'])
    ->name('adminProfile')
    ->middleware('role:1'); // Hanya izinkan admin

// Rute untuk mentor
Route::match(['get', 'post'], '/profile/mentor/{id}/{action?}', [ProfileController::class, 'mentorProfile'])
    ->name('mentorProfile')
    ->middleware('role:2'); // Hanya izinkan mentor

Route::match(['get', 'post'], '/profile/mahasiswa/{id}/{action?}', [ProfileController::class, 'mahasiswaProfile'])
    ->name('profileMahasiswa')
    ->middleware('role:3');

Route::get('/login', [LoginController::class, 'manualAuth'])->name('login');

// Rute untuk change password 
Route::post('/profile/updatePassword/{id_user}', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

// // Rute untuk change photo
Route::post('/user/profile/{id_user}/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::post('/mahasiswa/profile/{id_user}/update-photo', [ProfileController::class, 'updatePhotoMahasiswa'])->name('profile.updatePhotoMahasiswa');
