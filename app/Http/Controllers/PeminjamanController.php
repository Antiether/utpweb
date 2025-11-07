<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

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
            $peminjamen = Peminjaman::with('barang', 'user')->get();
        } else {
            $peminjamen = Peminjaman::with('barang', 'user')
                ->where('user_id', $user->id)
                ->get();
        }

        // Dekripsi catatan sebelum ditampilkan
        foreach ($peminjamen as $p) {
            if (!empty($p->catatan_terenkripsi)) {
                try {
                    $p->catatan_terenkripsi = decrypt($p->catatan_terenkripsi);
                } catch (\Exception $e) {
                    $p->catatan_terenkripsi = '[gagal dekripsi]';
                }
            }
        }

        return view('peminjaman.index', compact('peminjamen', 'user'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('peminjaman.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        Peminjaman::create([
            'user_id' => auth()->id(),
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
            'catatan_terenkripsi' => $request->catatan ? encrypt($request->catatan) : null,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = auth()->user();

        if ($user->role !== 'admin' && $peminjaman->user_id !== $user->id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit data ini.');
        }

        // Dekripsi catatan sebelum ditampilkan di form edit
        if ($peminjaman->catatan_terenkripsi) {
            try {
                $peminjaman->catatan_terenkripsi = decrypt($peminjaman->catatan_terenkripsi);
            } catch (\Exception $e) {
                $peminjaman->catatan_terenkripsi = '[gagal dekripsi]';
            }
        }

        $barangs = Barang::all();
        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = auth()->user();

        if ($user->role !== 'admin' && $peminjaman->user_id !== $user->id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengedit data ini.');
        }

        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tanggal_pinjam' => 'required|date',
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $peminjaman->update([
            'barang_id' => $request->barang_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => $request->status,
            'catatan_terenkripsi' => $request->catatan ? encrypt($request->catatan) : null,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus data peminjaman.');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus');
    }

    public function formPengembalian($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = auth()->user();

        if ($user->role !== 'admin' && $peminjaman->user_id !== $user->id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengembalikan barang ini.');
        }

        if ($peminjaman->status === 'dikembalikan') {
            return redirect()->route('peminjaman.index')->with('info', 'Barang ini sudah dikembalikan sebelumnya.');
        }

        // Dekripsi catatan sebelum tampil di form pengembalian (kalau mau ditampilkan)
        if ($peminjaman->catatan_terenkripsi) {
            try {
                $peminjaman->catatan_terenkripsi = decrypt($peminjaman->catatan_terenkripsi);
            } catch (\Exception $e) {
                $peminjaman->catatan_terenkripsi = '[gagal dekripsi]';
            }
        }

        return view('peminjaman.kembalikan', compact('peminjaman'));
    }

    public function prosesPengembalian(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $user = auth()->user();

        if ($user->role !== 'admin' && $peminjaman->user_id !== $user->id) {
            abort(403, 'Kamu tidak memiliki izin untuk mengembalikan barang ini.');
        }

        $request->validate([
            'tanggal_kembali' => 'required|date|after_or_equal:' . $peminjaman->tanggal_pinjam,
            'catatan' => 'nullable|string',
        ]);

        $peminjaman->update([
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dikembalikan',
            'catatan_terenkripsi' => $request->catatan ? encrypt($request->catatan) : null,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Barang berhasil dikembalikan.');
    }
}