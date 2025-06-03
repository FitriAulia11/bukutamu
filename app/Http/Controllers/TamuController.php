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
        'nama' => 'required|string|max:255',
        'keperluan' => 'required|string|max:255',
    ]);

    $tamu = Tamu::findOrFail($request->tamu_id);

    // Update hanya nama dan keperluan
    $tamu->nama = $request->nama;
    $tamu->keperluan = $request->keperluan;
    $tamu->save();

    // Jika ingin catat kunjungan baru
    Kunjungan::create([
        'tamu_id' => $tamu->id,
        'tanggal_kunjungan' => now(),
    ]);

    return redirect()->back()->with('success', 'Data Anda telah diperbarui, selamat datang kembali, ' . $tamu->nama . '!');
}


public function simpanKunjunganLama(Request $request)
{
    $request->validate([
        'tamu_id' => 'required|exists:tamus,id',
    ]);

    // Ambil data tamu lama
    $tamuLama = Tamu::findOrFail($request->tamu_id);

    // Buat salinan baru data tamu
  $tamuBaru = Tamu::create([
    'nama' => $tamuLama->nama,
    'telepon' => $tamuLama->telepon,
    'tanggal_datang' => $request->tanggal_kunjungan, // Ambil dari input form
    'alamat' => $tamuLama->alamat,
    'keperluan' => $request->keperluan,
    'kategori' => $request->kategori, // Ambil dari input form
]);


    // Buat kunjungan baru berdasarkan tamu yang barusan disalin
    Kunjungan::create([
        'tamu_id' => $tamuBaru->id,
        'tanggal_kunjungan' => now(),
    ]);

    return redirect()->back()->with('success', 'Selamat datang kembali, ' . $tamuBaru->nama . '!');
}


public function daftarTamu()
{
    $kunjungan = Kunjungan::with('tamu')
        ->orderByDesc('tanggal_kunjungan')
        ->get();

    return view('daftar-tamu', compact('kunjungan'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string',
        'telepon' => 'required|string',
        'alamat' => 'required|string',
        'keperluan' => 'required|string',
        'kategori' => 'required|string',
        'tanggal_datang' => 'required|date',
        'foto_base64' => 'nullable|string',
    ]);

    $fotoPath = null;

    // Jika ada base64 dari kamera
    if (!empty($request->foto_base64)) {
        $fotoData = $request->foto_base64;

        // Hapus prefix base64
        $fotoData = preg_replace('#^data:image/\w+;base64,#i', '', $fotoData);
        $fotoData = str_replace(' ', '+', $fotoData);
        $fotoDecoded = base64_decode($fotoData);

        // Nama file unik
        $fileName = 'tamu_' . uniqid() . '.png';

        // Simpan ke storage/app/public/foto_tamu/
        \Storage::disk('public')->put("foto_tamu/{$fileName}", $fotoDecoded);

        $fotoPath = "foto_tamu/{$fileName}";
    }

    // Simpan ke DB
    \App\Models\Tamu::create([
        'nama' => $validated['nama'],
        'telepon' => $validated['telepon'],
        'alamat' => $validated['alamat'],
        'keperluan' => $validated['keperluan'],
        'kategori' => $validated['kategori'],
        'tanggal_datang' => $validated['tanggal_datang'],
        'foto' => $fotoPath,
    ]);

    return redirect()->back()->with('success', 'Data tamu berhasil disimpan!');
}
}
