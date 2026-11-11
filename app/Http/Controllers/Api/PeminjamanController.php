<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan semua peminjaman
    public function index()
    {
        $peminjaman = Peminjaman::with('buku')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data peminjaman berhasil ditampilkan',
            'data' => $peminjaman
        ], 200);
    }

    // Menambahkan peminjaman
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pinjam' => 'required|string|max:25|unique:peminjaman,no_pinjam',
            'buku_id' => 'required|exists:buku,id',
            'nama_peminjam' => 'required|string|max:100',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after_or_equal:tanggal_pinjam',
            'tanggal_kembali' => 'nullable|date'
        ]);

        $peminjaman = Peminjaman::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil ditambahkan',
            'data' => $peminjaman
        ], 201);
    }

    // Menampilkan satu peminjaman
    public function show(string $id)
    {
        $peminjaman = Peminjaman::with('buku')->find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ], 200);
    }

    // Mengubah peminjaman
    public function update(Request $request, string $id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'no_pinjam' => 'sometimes|required|string|max:25|unique:peminjaman,no_pinjam,' . $id,
            'buku_id' => 'sometimes|required|exists:buku,id',
            'nama_peminjam' => 'sometimes|required|string|max:100',
            'tanggal_pinjam' => 'sometimes|required|date',
            'tanggal_pengembalian' => 'sometimes|required|date',
            'tanggal_kembali' => 'nullable|date'
        ]);

        $peminjaman->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diperbarui',
            'data' => $peminjaman
        ], 200);
    }

    // Menghapus peminjaman
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan'
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dihapus'
        ], 200);
    }
}
