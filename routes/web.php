<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\AdminTamuController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Redirect user setelah login sesuai role
Route::get('/redirect-role', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif (Auth::user()->role === 'user') {
            // Redirect ke halaman profile atau halaman lain yang kamu mau
            return redirect('/tamu.index');
        }
    }
    return abort(403);
});

// Auth bawaan Laravel
Auth::routes();

// Jika masih ada route home (bisa dihapus jika sudah tidak dipakai)
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');



// Route khusus user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [User::class, 'dashboard']);
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('user.show');
    // Route profile form tamu
    Route::get('/profile', [UserController::class, 'formTamu'])->name('form.tamu');          // tampilkan form
    Route::post('/profile', [UserController::class, 'storeTamu'])->name('form.tamu.store');  // proses simpan data

Route::get('/tamu/create', [UserController::class, 'createTamu'])->name('tamu.create');
Route::post('/tamu', [UserController::class, 'storeTamu'])->name('tamu.store');
Route::get('/tamu/{tamu}', [UserController::class, 'showTamu'])->name('tamu.show');
});




Route::get('/admin/form-tamu', [AdminController::class, 'formTamu'])->name('form.tamu.create');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/form-input', [AdminTamuController::class, 'index'])->name('admin.tamu.index');
    Route::get('/form-input/create', [AdminTamuController::class, 'create'])->name('admin.tamu.create');
    Route::post('/form-input', [AdminTamuController::class, 'store'])->name('admin.tamu.store');
    Route::get('/form-input/{id}/edit', [AdminTamuController::class, 'edit'])->name('admin.tamu.edit');
    Route::put('/form-input/{id}', [AdminTamuController::class, 'update'])->name('admin.tamu.update');
    Route::delete('/form-input/{id}', [AdminTamuController::class, 'destroy'])->name('admin.tamu.destroy');
});

Route::get('/tamu', [UserController::class, 'indexTamu'])->name('tamu.index');



Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // redirect ke halaman welcome
})->name('logout');