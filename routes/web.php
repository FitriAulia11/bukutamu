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
Route::get('/admin/jumlah-tamu', [AdminController::class, 'jumlahTamu'])->middleware('auth');



// Route khusus user
Route::middleware(['auth', 'role:user'])->group(function () {

    // Route profile form tamu
    Route::get('/tamu.index', [UserController::class, 'indexTamu'])->name('tamu.index');
    Route::get('/profile', [UserController::class, 'formTamu'])->name('form.tamu');          // tampilkan form
    Route::post('/profile', [UserController::class, 'storeTamu'])->name('form.tamu.store');  // proses simpan data

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
    Route::get('/pengguna/create', [PenggunaController::class, 'create'])->name('admin.pengguna.create');
    Route::post('/pengguna', [PenggunaController::class, 'store'])->name('admin.pengguna.store');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');
});
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/form-input', [AdminTamuController::class, 'index'])->name('admin.tamu.index');
    Route::get('/form-input/create', [AdminTamuController::class, 'create'])->name('admin.tamu.create');
    Route::post('/form-input', [AdminTamuController::class, 'store'])->name('admin.tamu.store');
    Route::get('/form-input/{id}/edit', [AdminTamuController::class, 'edit'])->name('admin.tamu.edit');
    Route::put('/form-input/{id}', [AdminTamuController::class, 'update'])->name('admin.tamu.update');
    Route::delete('/form-input/{id}', [AdminTamuController::class, 'destroy'])->name('admin.tamu.destroy');
});
