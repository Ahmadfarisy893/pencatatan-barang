<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Barang;
use App\Models\Peminjaman;
use Vinkla\Hashids\Facades\Hashids;

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
            'status_kerja' => 'required|in:Aktif,Pensiun,Mengundurkan Diri',
            'foto' => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // cek apakah ada foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

        // simpan di public/image/pegawai
        $file->move(public_path('image/pegawai'), $filename);

        // simpan nama file ke database
        $pegawai->foto = $filename;
        }

        $pegawai->save();
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
    $pegawai = Pegawai::findOrFail($id);

    $pegawai->nip = $request->nip;
    $pegawai->nama = $request->nama;
    $pegawai->jenis_kelamin = $request->jenis_kelamin;
    $pegawai->status_kerja = $request->status_kerja;

    if ($request->hasFile('foto')) {
        // hapus foto lama kalau ada
        if ($pegawai->foto && file_exists(public_path('image/pegawai/' . $pegawai->foto))) {
            unlink(public_path('image/pegawai/' . $pegawai->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('image/pegawai'), $filename);

        $pegawai->foto = $filename;
    }

    $pegawai->save();

    return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diupdate');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Data berhasil dihapus.');
    }

    public function view($id)
    {
    $decoded = Hashids::decode($id);

    if (empty($decoded)) {
        abort(404, 'ID tidak valid'); // kalau id hasil decode kosong
    }

    $pegawaiId = $decoded[0]; // ambil id asli
    $pegawai = Pegawai::findOrFail($pegawaiId);

    // Ambil daftar peminjaman untuk pegawai ini
    $peminjaman = Peminjaman::with('barang.category')
        ->where('nip', $pegawai->nip) // filter berdasarkan nip
        ->orderBy('tanggal_pemberian', 'desc')
        ->get();

    return view('pegawai.view', compact('pegawai', 'peminjaman'));
    }

}
