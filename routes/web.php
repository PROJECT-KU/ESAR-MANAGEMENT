<?php



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
use App\Http\Controllers\Public\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::get('/editor', [HomeController::class, 'editor'])->name('public.editor');
Route::get('/training', [HomeController::class, 'training'])->name('public.training');
Route::get('/digital-service', [HomeController::class, 'digitalservice'])->name('public.digitalservice');
Route::get('/contact', [HomeController::class, 'contact'])->name('public.contact');
// <!--================== END ==================-->

// <!--================== AUTH ==================-->
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('auth.login');
})->middleware('registered');

use App\Http\Controllers\Auth\LoginController;

Route::get('/admin', [LoginController::class, 'index'])->name('auth.admin');
Route::post('/login', [LoginController::class, 'login'])->name('login');;
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// REGISTER
use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'index'])->name('auth.view.register');
Route::post('/register-proses', [RegisterController::class, 'register'])->name('auth.register');
// END
// <!--================== END ==================-->
