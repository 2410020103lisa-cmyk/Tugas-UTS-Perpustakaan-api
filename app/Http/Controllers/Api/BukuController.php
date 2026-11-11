<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $buku = Buku::all();

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil ditampilkan',
            'data' => $buku
        ], 200);
    }

    // Menambahkan buku
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|string|max:25|unique:buku,kode_buku',
            'nama_buku' => 'required|string|max:225',
            'pengarang' => 'required|string|max:225',
            'penerbit' => 'required|string|max:225',
            'tahun_terbit' => 'nullable|integer|min:1000|max:2155',
            'jumlah_total' => 'required|integer|min:0',
            'jumlah_tersedia' => 'required|integer|min:0|lte:jumlah_total',
            'rak' => 'nullable|string|max:225'
        ]);

        $buku = Buku::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }

    // Menampilkan satu buku
    public function show(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $buku
        ], 200);
    }

    // Mengubah data buku
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kode_buku' => 'sometimes|required|string|max:25|unique:buku,kode_buku,' . $id,
            'nama_buku' => 'sometimes|required|string|max:225',
            'pengarang' => 'sometimes|required|string|max:225',
            'penerbit' => 'sometimes|required|string|max:225',
            'tahun_terbit' => 'nullable|integer|min:1000|max:2155',
            'jumlah_total' => 'sometimes|required|integer|min:0',
            'jumlah_tersedia' => 'sometimes|required|integer|min:0|lte:jumlah_total',
            'rak' => 'nullable|string|max:225'
        ]);

        $buku->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diperbarui',
            'data' => $buku
        ], 200);
    }

    // Menghapus buku
    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus'
        ], 200);
    }
}
