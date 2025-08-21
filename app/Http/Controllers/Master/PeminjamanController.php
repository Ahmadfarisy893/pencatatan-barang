<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\peminjaman;
use App\Models\barang;
use App\Models\pegawai;
use Barryvdh\DomPDF\Facade\Pdf;




class PeminjamanController extends Controller
{
     public function index()
    {
        $peminjamans = Peminjaman::with(['barang.category'])->orderBy('created_at', 'desc')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }
    public function create()
    {
        $barangs = Barang::with('category')->orderBy('nama_barang')->get();
        $pegawais = Pegawai::all();
        return view('peminjaman.create', compact('barangs', 'pegawais'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'               => 'required|string|max:50',
            'nama_pegawai'      => 'required|string|max:255',
            'barang_id'         => 'required|exists:barang,id',
            'jumlah'            => 'required|integer|min:1',
            'tanggal_pemberian' => 'required|date',
        ]);

        $barang = Barang::findOrFail($validated['barang_id']);
        if ($validated['jumlah'] > $barang->jumlah) {
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok tersedia'])->withInput();
        }

        $barang->decrement('jumlah', $validated['jumlah']);
        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman barang berhasil disimpan.');
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $barangs = Barang::with('category')->orderBy('nama_barang')->get();
        return view('peminjaman.edit', compact('peminjaman', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validated = $request->validate([
            'nip'               => 'required|string|max:50',
            'nama_pegawai'      => 'required|string|max:255',
            'barang_id'         => 'required|exists:barang,id',
            'jumlah'            => 'required|integer|min:1',
            'tanggal_pemberian' => 'required|date',
        ]);

        // kembalikan stok lama
        $oldBarang = Barang::findOrFail($peminjaman->barang_id);
        $oldBarang->increment('jumlah', $peminjaman->jumlah);

        $newBarang = Barang::findOrFail($validated['barang_id']);
        if ($validated['jumlah'] > $newBarang->jumlah) {
            // rollback perubahan stok lama agar konsisten
            $oldBarang->decrement('jumlah', $peminjaman->jumlah);
            return back()->withErrors(['jumlah' => 'Jumlah melebihi stok tersedia'])->withInput();
        }

        $newBarang->decrement('jumlah', $validated['jumlah']);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diupdate.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $barang = Barang::findOrFail($peminjaman->barang_id);
        $barang->increment('jumlah', $peminjaman->jumlah);

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
    public function cetak($id)
    {
        // Ambil data + relasi yang dibutuhkan
        $loan = Peminjaman::with(['barang.category'])->findOrFail($id);

        // Render view ke PDF
        $pdf = Pdf::loadView('peminjaman.cetak', [
            'loan' => $loan,
        ])->setPaper('A4', 'portrait');

        // ?dl=1 untuk paksa download, default preview (stream)
        $filename = 'BAST_'.$loan->nip.'_'.$loan->id.'.pdf';
        return request()->boolean('dl')
            ? $pdf->download($filename)
            : $pdf->stream($filename);
    }
}
