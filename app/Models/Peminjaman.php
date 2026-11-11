<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    public $timestamps = false;

    protected $fillable = [
        'no_pinjam',
        'buku_id',
        'nama_peminjam',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'tanggal_kembali'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
