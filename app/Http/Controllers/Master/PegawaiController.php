<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Barang;
use App\Models\Peminjaman;


class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all(); // Ambil semua data pegawai
        return view('pegawai.index', compact('pegawai'));
    }
    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|unique:pegawai,nip|max:20',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);
        
        Pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,

        ]);
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|string|max:20|unique:pegawai,nip,' . $id,
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil diupdate.');
    }
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus.');
    }
    public function view($id)
    {
    $pegawai = Pegawai::findOrFail($id); // cari berdasarkan ID, error jika tidak ketemu
    $barangDipinjam = Peminjaman::where('pegawai_id', $pegawai->id)->with('barang')->get();

    return view('pegawai.view', compact('pegawai', 'barangDipinjam'));
    }

}
