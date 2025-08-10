<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\categories;

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
        ]);

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
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }    
}
