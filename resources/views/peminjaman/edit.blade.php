@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4 class="text-gray-900">Edit Peminjaman Barang</h4>
                </div>

                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="user">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="mb-3 p-3 bg-danger text-white rounded">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="nip" class="block font-medium mb-1">NIP</label>
                        <input type="text" name="nip" class="form-control form-control-user"
                               value="{{ old('nip', $peminjaman->nip) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_pegawai" class="block font-medium mb-1">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" class="form-control form-control-user"
                               value="{{ old('nama_pegawai', $peminjaman->nama_pegawai) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="barang_id" class="block font-medium mb-1">Barang</label>
                        <select name="barang_id" class="form-control form-control-user" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}"
                                    {{ old('barang_id', $peminjaman->barang_id) == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }} ({{ optional($b->category)->name }}) — Stok: {{ $b->jumlah + ($peminjaman->barang_id == $b->id ? $peminjaman->jumlah : 0) }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">
                            *Stok ditampilkan termasuk pengembalian dari peminjaman saat ini agar tidak salah tarik.
                        </small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jumlah" class="block font-medium mb-1">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control form-control-user"
                               value="{{ old('jumlah', $peminjaman->jumlah) }}" min="1" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_pemberian" class="block font-medium mb-1">Tanggal Pemberian</label>
                        <input type="date" name="tanggal_pemberian" class="form-control form-control-user"
                               value="{{ old('tanggal_pemberian', $peminjaman->tanggal_pemberian) }}" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <button type="submit" class="btn btn-success btn-user w-50">
                            Update Data
                        </button>
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary btn-user">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
