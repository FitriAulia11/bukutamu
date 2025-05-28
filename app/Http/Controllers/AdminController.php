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

        return view('admin.dashboard', compact('totalPengguna', 'totalTamu'));
    }

    public function jumlahTamu()
{
    $months = [];
    $tamuCounts = [];

    for ($i = 0; $i < 6; $i++) {
        $month = Carbon::now()->subMonths($i)->format('Y-m');
        $label = Carbon::now()->subMonths($i)->translatedFormat('F Y');
        $count = Tamu::whereYear('created_at', substr($month, 0, 4))
                     ->whereMonth('created_at', substr($month, 5, 2))
                     ->count();

        array_unshift($months, $label); // urutan bulan dari lama ke terbaru
        array_unshift($tamuCounts, $count);
    }

    return view('admin.jumlah-tamu', [
        'months' => $months,
        'tamuCounts' => $tamuCounts
    ]);
}

}
