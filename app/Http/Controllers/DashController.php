<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pegawai;
use App\Models\barang;
use App\Models\peminjaman;
use App\Models\User;

class DashController extends Controller
{
    public function dashboard()
    {
        $jumlahPegawai = Pegawai::count();
        $jumlahBarang = Barang::count();
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahUser = User::count();
        return view('dashboard', compact('jumlahPegawai', 'jumlahBarang', 'jumlahPeminjaman', 'jumlahUser'));
    }
}
