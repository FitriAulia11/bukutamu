<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function formTamu()
    {
        return view('user.form_tamu');
    }

    public function storeTamu(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|string',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
            'kategori' => 'required|string',
        ]);

        Tamu::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'tanggal_datang' => Carbon::now(),
            'alamat' => $request->alamat,
            'keperluan' => $request->keperluan,
            'kategori' => $request->kategori,
        ]);

        return redirect()->back()->with('success', 'Data tamu berhasil disimpan.');
    }
       public function create()
    {
        return view('tamu.create'); // file blade untuk form input
    }

    // Simpan data tamu
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'tanggal' => 'required|date',
            'alamat' => 'required|string',
            'keperluan' => 'required|string',
            'kategori' => 'required|string',
        ]);

        $tamu = Tamu::create($data);

        return redirect()->route('user.show', $tamu->id)
                         ->with('success', 'Data tamu berhasil disimpan!');
    }

    // Tampilkan detail data tamu
    public function show($id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('tamu.show', compact('tamu'));
    }

public function indexTamu(Request $request)
{
    $query = Tamu::query();

    if ($request->filled('search')) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal_datang', $request->tanggal);
    }

    $tamus = $query->orderBy('tanggal_datang', 'desc')->paginate(10);

    return view('tamu.index', [
        'tamus' => $tamus,
        'search' => $request->search,
        'tanggal' => $request->tanggal,
    ]);
}
}
