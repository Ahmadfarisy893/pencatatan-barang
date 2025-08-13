@extends('dashboard')

@section('content')
<div class="container m-0">
    <h1 class="mb-4">Data Peminjaman Barang</h1>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h4 class="mb-0">Peminjaman</h4>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Peminjaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <table class="table table-bordered table-responsive table-hover align-middle text-center rounded-3 overflow-hidden">
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
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('peminjaman.edit', $loan->id) }}" class="btn btn-sm btn-warning rounded-pill">Update</a>
                            <!--
                            <form action="{{ route('peminjaman.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus peminjaman?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger rounded-pill">Hapus</button> -->
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
</div>

{{-- CSS khusus --}}
<style>
    /* Supaya sudut tabel melengkung */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.75rem; /* radius 12px */
        box-shadow: 1px 2px 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    tbody {
        background-color: #F8FAFC; /* Warna latar belakang tabel */
        color: #030303ff;
    }

   
</style>
@endsection
