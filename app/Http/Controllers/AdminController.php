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

        // Tahun sekarang
        $year = Carbon::now()->year;
        $nowMonth = Carbon::now()->month;

        // Generate array bulan dari Januari sampai bulan sekarang
        $labels = [];
        for ($m = 1; $m <= $nowMonth; $m++) {
            // Format nama bulan dan tahun, misal "Januari 2025"
            $labels[] = Carbon::create($year, $m, 1)->translatedFormat('F Y');
        }

        // Ambil data tamu per bulan dari database untuk tahun ini
        $tamuPerBulan = DB::table('tamus')
            ->select(
                DB::raw("MONTH(tanggal_datang) as bulan"),
                DB::raw("COUNT(*) as total")
            )
            ->whereYear('tanggal_datang', $year)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');  // Key by bulan untuk mudah lookup

        // Gabungkan data tamu dengan semua bulan (isi 0 jika tidak ada data)
        $data = [];
        for ($m = 1; $m <= $nowMonth; $m++) {
            $data[] = isset($tamuPerBulan[$m]) ? $tamuPerBulan[$m]->total : 0;
        }

        return view('admin.dashboard', compact('totalPengguna', 'totalTamu', 'labels', 'data'));
    }
}
