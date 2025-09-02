<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\categories;
use Vinkla\Hashids\Facades\Hashids;

class BarangController extends Controller
{
     public function index()
    {
        $barangs = Barang::with('category')->orderBy('created_at', 'desc')->get();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $categories = Categories::orderBy('name')->get();
        return view('barang.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'nama_barang'   => 'required|string|max:255',
            'kode_barang'   => 'required|string|max:100|unique:barang,kode_barang',
            'jumlah'        => 'required|integer|min:0',
            'kondisi'       => 'required|string|in:baik,rusak,perlu perbaikan',
            'foto'          => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);
        // cek apakah ada upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            // simpan di public/image/barang
            $file->move(public_path('image/barang'), $filename);

            // masukkan nama file ke array validated
            $validated['foto'] = $filename;
        }

        Barang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $categories = Categories::orderBy('name')->get();
        return view('barang.edit', compact('barang', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'nama_barang'   => 'required|string|max:255',
            'kode_barang'   => 'required|string|max:100|unique:barang,kode_barang,' . $barang->id,
            'jumlah'        => 'required|integer|min:0',
            'kondisi'       => 'required|string|in:baik,rusak,perlu perbaikan',
            'foto'          => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // cek apakah ada upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();

            // simpan di public/image/barang
            $file->move(public_path('image/barang'), $filename);

            // masukkan nama file ke array validated
            $validated['foto'] = $filename;
        }

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }    

    public function view($id)
    {
    $decoded = Hashids::decode($id);

    if (empty($decoded)) {
        abort(404, 'ID tidak valid'); // kalau id hasil decode kosong
    }

    $barangId = $decoded[0]; // ambil id asli
    $barang = Barang::with(['peminjaman.pegawai'])->findOrFail($barangId);

    return view('barang.view', compact('barang'));
    }
}
