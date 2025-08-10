<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawai';
    protected $fillable = ['nip', 'nama', 'jenis_kelamin'];

    public function peminjaman()
    {
    return $this->hasMany(Peminjaman::class);
    }

}
