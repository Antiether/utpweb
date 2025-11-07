<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $barangs = Barang::all();

        return view('barang.index', compact('barangs', 'user'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang bisa menambah barang!');
        }

        return view('barang.create');
    }

    public function store(Request $request)
    {
        // validasi tetap dibolehkan karena bisa dipakai admin
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang bisa mengedit barang!');
        }

        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang bisa memperbarui barang!');
        }

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang bisa menghapus barang!');
        }

        Barang::destroy($id);
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }
}