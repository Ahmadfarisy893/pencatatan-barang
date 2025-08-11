<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'barang_id',
        'jumlah',
        'tanggal_pemberian',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    // mengambil nilai kategori dari barang yang dipinjam
    public function category()
    {
        return $this->barang?->category();
    }
}
