<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\TrainingsController;
use App\Http\Controllers\Public\TrainingsPendaftaransController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProfilController;
use App\Http\Controllers\admin\DataPenggunaController;
use App\Http\Controllers\admin\DataTrainingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// <!--================== PUBLIC HOME ==================-->
Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::get('/editor', [HomeController::class, 'editor'])->name('public.editor');
Route::get('/training', [HomeController::class, 'training'])->name('public.training');
Route::get('/training/view-training/{id}', [HomeController::class, 'view'])->name('public.training-view');
Route::get('/digital-service', [HomeController::class, 'digitalservice'])->name('public.digitalservice');
Route::get('/contact', [HomeController::class, 'contact'])->name('public.contact');
// <!--================== END ==================-->

// <!--================== PUBLIC TRAININGS ==================-->
Route::get('/training', [TrainingsController::class, 'training'])->name('public.training');
Route::get('/training/view-training/{id}', [TrainingsController::class, 'view'])->name('public.training-view');
Route::get('/training/pendaftaran-view/{id}', [TrainingsController::class, 'PendaftaranView'])->name('public.training.pendaftaran.view');
Route::post('/check-promo-code/{id}', [TrainingsController::class, 'checkPromoCode'])->name('public.training.check.promo.code');
// <!--================== END ==================-->

// <!--================== PUBLIC TRAININGS ==================-->
Route::post('/training/pendaftaran/create', [TrainingsPendaftaransController::class, 'store'])->name('public.training.pendaftaran.store');
// <!--================== END ==================-->

// <!--================== AUTH ==================-->
Route::get('/admin', function () {
    return view('auth.login');
})->middleware('registered');

Route::get('/admin', [LoginController::class, 'index'])->name('auth.admin');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

// REGISTER
Route::get('/register', [RegisterController::class, 'index'])->name('auth.view.register');
Route::post('/register-proses', [RegisterController::class, 'register'])->name('auth.register');
// <!--================== END ==================-->

// <!--================== DASBOARD ADMIN ==================-->
Route::middleware(['auth'])->group(function () {
    // DASBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('auth.view.dashboard');
    // PROFIL
    Route::get('/profil', [ProfilController::class, 'index'])->name('auth.view.profil');
    Route::post('/update-foto-profil', [ProfilController::class, 'updatePhoto'])->name('auth.update.fotoprofil');
    Route::post('/update-data-profil', [ProfilController::class, 'update'])->name('auth.update.dataprofil');
    Route::post('/verify-email', [ProfilController::class, 'verifyEmail'])->name('verify.email');
    Route::post('/verify-code', [ProfilController::class, 'verify'])->name('verify.code');
    Route::post('/reset-password', [ProfilController::class, 'resetPassword'])->name('reset.password');
    // DATA PENGGUNA
    Route::get('/pengguna', [DataPenggunaController::class, 'index'])->name('auth.view.pengguna');
    Route::get('/pengguna-edit/{id}', [DataPenggunaController::class, 'edit'])->name('auth.view.edit');
    Route::post('/pengguna-update/{id}', [DataPenggunaController::class, 'update'])->name('auth.update.edit');
    Route::post('/pengguna-update/FotoProfil/{id}', [DataPenggunaController::class, 'updatePhoto'])->name('auth.update.edit.FotoProfil');
    Route::post('/pengguna-update/ResetPassword/{id}', [DataPenggunaController::class, 'resetPassword'])->name('auth.update.edit.ResetPassword');
    Route::delete('/pengguna/delete/{id}', [DataPenggunaController::class, 'destroy'])->name('auth.delete.data');
    // DATA TRAINING
    Route::get('/Data-Trainings', [DataTrainingsController::class, 'index'])->name('auth.view.trainings');
    Route::get('/Data-Trainings/tambah', [DataTrainingsController::class, 'create'])->name('auth.view.create');
    Route::post('/Data-Trainings/store', [DataTrainingsController::class, 'store'])->name('auth.create.store');
    Route::get('/Data-Trainings/edit/{id}', [DataTrainingsController::class, 'edit'])->name('auth.view.Trainings.edit');
    Route::post('/Data-Trainings/update/{id}', [DataTrainingsController::class, 'update'])->name('auth.Trainings.update');
    Route::delete('/Data-Trainings/delete/{id}', [DataTrainingsController::class, 'destroy'])->name('auth.Trainings.delete');
});
// <!--================== END ==================-->
