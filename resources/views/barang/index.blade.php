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
    <table class="table table-bordered table-striped table-responsive table-hover align-middle text-center rounded-3 overflow-hidden">
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
                    <td> @php
                            if ($barang->kondisi === 'baik') {
                                $badgeClass = 'badge bg-light-success text-success';
                            } elseif ($barang->kondisi === 'rusak') {
                                $badgeClass = 'badge bg-light-danger text-danger';
                            } elseif ($barang->kondisi === 'perlu perbaikan') {
                                $badgeClass = 'badge bg-light-warning text-warning';
                            } else {
                                $badgeClass = 'badge bg-secondary';
                            }
                        @endphp
                        <span class="{{ $badgeClass }}">{{ ucfirst($barang->kondisi) }}</span>
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-warning rounded-pill">
                            Update
                        </a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill">
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