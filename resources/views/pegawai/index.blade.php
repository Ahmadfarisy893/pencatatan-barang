@extends('dashboard')

@section('content')
<div class="container">
    <h1>Daftar Pegawai</h1>
    <p>Ini adalah halaman daftar pegawai.</p>
        <div class="d-flex justify-content-between align-items-center mt-5 mb-3 ">
            <h4 class="mb-0">Data Pegawai</h4>
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Tambah Pegawai
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
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
                <th>Action</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
           @forelse ($pegawai as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>
                        @php
                            if ($item->status_kerja === 'Aktif') {
                                $badgeClass = 'badge bg-light-success text-success';
                            } elseif ($item->status_kerja === 'Pensiun') {
                                $badgeClass = 'badge bg-light-warning text-warning';
                            } elseif ($item->status_kerja === 'Mengundurkan Diri') {
                                $badgeClass = 'badge bg-light-primary text-primary';
                            } else {
                                $badgeClass = 'badge bg-secondary';
                            }
                        @endphp
                        <span class="{{ $badgeClass }}">{{ $item->status_kerja }}</span>
                    </td>
                    <td>
                        <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning rounded-pill">Update</a>
                        <!--<form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>-->
                    </td>
                    <td>
                        <a href="{{ route('pegawai.view', $item->id) }}" class="btn btn-sm btn-info rounded-pill">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data pegawai</td>
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