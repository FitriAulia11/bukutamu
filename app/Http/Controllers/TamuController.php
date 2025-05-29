<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use App\Models\Kunjungan;

class TamuController extends Controller
{
  public function index()
{
    $daftarTamu = Tamu::all();
    return view('welcome', compact('daftarTamu'));
}

public function hadirUlang(Request $request)
{
    $request->validate([
        'tamu_id' => 'required|exists:tamus,id',
    ]);

    // Bisa simpan data ke tabel baru atau update status di tabel tamu
    // Contoh sederhana:
    DB::table('riwayat_kunjungan')->insert([
        'tamu_id' => $request->tamu_id,
        'waktu_kunjungan' => now(),
    ]);

    return back()->with('success', 'Terima kasih, kehadiran Anda sudah dicatat.');
}

public function tamuLama(Request $request)
{
    $request->validate([
        'tamu_id' => 'required|exists:tamus,id',
    ]);

    $tamu = Tamu::find($request->tamu_id);

    // Terserah kamu mau redirect ke mana, contoh:
    return redirect()->back()->with('success', 'Selamat datang kembali, ' . $tamu->nama . '!');
}

    public function simpanKunjunganLama(Request $request)
    {
        $request->validate([
            'tamu_id' => 'required|exists:tamus,id',
        ]);

        // Simpan data kunjungan baru
        Kunjungan::create([
            'tamu_id' => $request->tamu_id,
            'tanggal_kunjungan' => now(),
        ]);

        $tamu = \App\Models\Tamu::find($request->tamu_id);

        return redirect()->back()->with('success', 'Selamat datang kembali, ' . $tamu->nama . '!');
    }

}
