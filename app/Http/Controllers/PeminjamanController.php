<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    $user = auth()->user();

    if ($user->role === 'admin') {
        $peminjaman = Peminjaman::all();
    } else {
        $peminjaman = Peminjaman::where('user_id', $user->id)->get();
    }

    return view('peminjaman.index', compact('peminjaman'));
    }


    public function create()
    {
        $barangs = Barang::all();
        return view('peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'catatan_terenkripsi' => 'nullable|string',
        ]);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
            'catatan_terenkripsi' => $request->catatan_terenkripsi,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $barangs = Barang::all();
        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'barang_id' => $request->barang_id,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
            'catatan_terenkripsi' => $request->catatan_terenkripsi,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        Peminjaman::findOrFail($id)->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman dihapus');
    }
}