@extends('dashboard')

@section('content')
<div class="container">
    <h1>Data Peminjaman Barang</h1>
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h4 class="mb-0">Peminjaman</h4>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Peminjaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Pegawai</th>
                <th>Barang</th>
                <th>Jenis / Kategori</th>
                <th>Jumlah</th>
                <th>Tanggal Pemberian</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
             @forelse($peminjamans as $i => $loan)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $loan->nip }}</td>
                    <td>{{ $loan->nama_pegawai }}</td>
                    <td>{{ optional($loan->barang)->nama_barang }}</td>
                    <td>{{ optional(optional($loan->barang)->category)->name }}</td>
                    <td>{{ $loan->jumlah }}</td>
                    <td>{{ \Carbon\Carbon::parse($loan->tanggal_pemberian)->format('d-m-Y') }}</td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('peminjaman.edit', $loan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('peminjaman.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus peminjaman?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
