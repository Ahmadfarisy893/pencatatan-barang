@extends('dashboard')

@section('content')
<div class="container">
    <h1>Data Barang</h1>
        <div class="d-flex justify-content-between align-items-center mt-5 mb-3 ">
            <h4 class="mb-0">Barang</h4>
                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Tambah Barang
                </a>
        </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Kondisi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $index => $barang)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ optional($barang->category)->name }}</td>
                    <td>{{ $barang->jumlah }}</td>
                    <td>{{ ucfirst($barang->kondisi) }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection