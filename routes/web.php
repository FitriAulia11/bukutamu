<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
            return redirect('/dashboard');
        }
    }
    return abort(403);
});

// Auth bawaan Laravel
Auth::routes();

// Jika masih ada route home (bisa dihapus jika sudah tidak dipakai)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Halaman Admin';
    });

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Route khusus user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
         return view('user.dashboard');
    });

 Route::get('/profile', [UserController::class, 'formTamu'])->name('form.tamu');          // tampilkan form
 Route::post('/profile', [UserController::class, 'storeTamu'])->name('form.tamu.store');  // proses simpan data

Route::get('/tamu', [UserController::class, 'indexTamu'])->name('tamu.index');
Route::get('/form/tamu/create', [UserController::class, 'create'])->name('form.tamu.create');
Route::post('/form/tamu/store', [UserController::class, 'store'])->name('form.tamu.store');
Route::get('/form/tamu/{id}', [UserController::class, 'show'])->name('user.show');
});

