<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tamu;

class AdminTamuController extends Controller
{
    public function index(Request $request)
    {
        $query = Tamu::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_datang', $request->tanggal);
        }

        $tamus = $query->latest()->paginate(10);

        return view('admin.tamu.index', compact('tamus'));
    }

    public function create()
    {
        return view('admin.tamu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            'kategori' => 'required',
            'tanggal_datang' => 'required|date',
        ]);

        Tamu::create($request->all());

        return redirect()->route('admin.tamu.index')->with('success', 'Data tamu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tamu = Tamu::findOrFail($id);
        return view('admin.tamu.edit', compact('tamu'));
    }

    public function update(Request $request, $id)
    {
        $tamu = Tamu::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'keperluan' => 'required',
            'kategori' => 'required',
            'tanggal_datang' => 'required|date',
        ]);

        $tamu->update($request->all());

        return redirect()->route('admin.tamu.index')->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Tamu::findOrFail($id)->delete();
        return redirect()->route('admin.tamu.index')->with('success', 'Data tamu berhasil dihapus.');
    }
}
