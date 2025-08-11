<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['category_id', 'nama_barang', 'kode_barang', 'jumlah', 'kondisi'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

}
