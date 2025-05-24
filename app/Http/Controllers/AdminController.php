<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function kelolaPengguna()
{
    // Ambil data jumlah tamu per bulan untuk tahun ini
    $tamuPerBulan = User::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
        ->whereYear('created_at', now()->year)
        ->where('role', 'user') // Sesuaikan dengan field role kamu
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    // Siapkan array bulan dan jumlah tamu
    $labels = [];
    $data = [];

    for ($i = 1; $i <= 12; $i++) {
        $labels[] = Carbon::create()->month($i)->format('F'); // Januari, Februari, ...
        $found = $tamuPerBulan->firstWhere('bulan', $i);
        $data[] = $found ? $found->total : 0;
    }

    return view('admin.kelola_pengguna', [
        'labels' => $labels,
        'data' => $data,
    ]);
}

public function formTamu()
{
    return view('admin.input-tamu');
}

public function storeTamu(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required',
        'telepon' => 'required',
        'tanggal' => 'required|date',
        'alamat' => 'required',
        'keperluan' => 'required',
        'kategori' => 'required',
    ]);

    Tamu::create($validated);

    return redirect()->route('admin.form.tamu')->with('success', 'Data tamu berhasil disimpan!');
}


}
