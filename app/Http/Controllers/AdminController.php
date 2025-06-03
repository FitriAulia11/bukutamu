<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
  public function dashboard()
{
    $totalPengguna = User::count();
    $totalTamu = Tamu::count();

    // Tambahkan ini untuk menghitung tamu hari ini
    $totalTamuHariIni = Tamu::whereDate('tanggal_datang', Carbon::today())->count();

    $year = Carbon::now()->year;
    $nowMonth = Carbon::now()->month;

    // Generate array bulan dari Januari sampai bulan sekarang
    $labels = [];
    for ($m = 1; $m <= $nowMonth; $m++) {
        $labels[] = Carbon::create($year, $m, 1)->translatedFormat('F Y');
    }

    $tamuPerBulan = DB::table('tamus')
        ->select(
            DB::raw("MONTH(tanggal_datang) as bulan"),
            DB::raw("COUNT(*) as total")
        )
        ->whereYear('tanggal_datang', $year)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get()
        ->keyBy('bulan');

    $data = [];
    for ($m = 1; $m <= $nowMonth; $m++) {
        $data[] = isset($tamuPerBulan[$m]) ? $tamuPerBulan[$m]->total : 0;
    }

    return view('admin.dashboard', compact(
        'totalPengguna',
        'totalTamu',
        'totalTamuHariIni',
        'labels',
        'data'
    ));
}
}
