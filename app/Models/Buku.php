<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    public $timestamps = false;

    protected $fillable = [
        'kode_buku',
        'nama_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'jumlah_total',
        'jumlah_tersedia',
        'rak'
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
