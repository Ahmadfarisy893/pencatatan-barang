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
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
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
                        <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('pegawai.view', $item->id) }}" class="btn btn-sm btn-info">View</a>
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
@endsection