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
    // Hitung total tamu bulan ini berdasarkan tanggal_datang
    $totalTamu = DB::table('tamus')
        ->whereMonth('tanggal_datang', Carbon::now()->month)
        ->whereYear('tanggal_datang', Carbon::now()->year)
        ->count();

    // Ambil data tamu per bulan sepanjang tahun ini berdasarkan tanggal_datang
    $monthlyData = DB::table('tamus')
        ->selectRaw('MONTH(tanggal_datang) as month, COUNT(*) as count')
        ->whereYear('tanggal_datang', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Format data untuk grafik
    $labels = [];
    $data = [];

    for ($i = 1; $i <= 12; $i++) {
        $labels[] = Carbon::create()->month($i)->locale('id')->translatedFormat('F');
        $found = $monthlyData->firstWhere('month', $i);
        $data[] = $found ? $found->count : 0;
    }

    return view('admin.dashboard', [
        'totalTamu' => $totalTamu,
        'labels' => json_encode($labels),
        'data' => json_encode($data),
    ]);
}

}
