<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Tempat untuk mengarahkan pengguna setelah registrasi.
     *
     * @var string
     */
    protected $redirectTo = '/login'; // Setelah registrasi, redirect ke halaman login

    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); // Pastikan middleware guest digunakan
    }

    /**
     * Mendapatkan validator untuk permintaan registrasi yang masuk.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:user,admin'], // Validasi role
        ]);
    }

    /**
     * Membuat instance pengguna baru setelah pendaftaran yang valid.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Buat pengguna baru tanpa login otomatis
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
    }

    /**
     * Override method registered untuk redirect ke login setelah registrasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registered(Request $request, $user)
    {
        // Logout user setelah registrasi
        $this->guard()->logout();

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}