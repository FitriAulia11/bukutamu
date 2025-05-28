<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;

class UserController extends Controller
{
public function storeTamuPublik(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'alamat' => 'required|string|max:255',
        'keperluan' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'tanggal_datang' => 'required|date',
    ]);

    Tamu::create([
        'nama' => $request->nama,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'keperluan' => $request->keperluan,
        'kategori' => $request->kategori,
        'tanggal_datang' => $request->tanggal_datang,
    ]);

    return redirect('/')->with('success', 'Terima kasih, data Anda berhasil disimpan!');
}
}
