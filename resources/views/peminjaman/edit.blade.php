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
                        <select name="nama_pegawai" id="nama_pegawai" class="form-control form-control-user" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach($pegawais as $p)
                                <option value="{{ $p->nama }}" 
                                        data-nip="{{ $p->nip }}" 
                                        data-foto="{{ $p->foto }}"
                                        {{ old('nama_pegawai', $peminjaman->nama_pegawai) == $p->nama ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Hidden input untuk simpan foto --}}
                        <input type="hidden" name="foto_pegawai" id="foto_pegawai" value="{{ old('foto_pegawai', $peminjaman->foto_pegawai) }}">

                        {{-- Preview foto pegawai --}}
                        <div class="mt-2">
                            <img id="previewPegawai" 
                                src="{{ $peminjaman->foto_pegawai ? asset('image/pegawai/'.$peminjaman->foto_pegawai) : asset('sneat/assets/img/avatars/1.png') }}" 
                                alt="Foto Pegawai" 
                                class="rounded" 
                                width="100" height="100"
                                style="object-fit:cover;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="barang_id" class="block font-medium mb-1">Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control form-control-user" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}" 
                                        data-foto="{{ $b->foto }}"
                                        {{ old('barang_id', $peminjaman->barang_id) == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }} ({{ optional($b->category)->name }}) — 
                                    Stok: {{ $b->jumlah + ($peminjaman->barang_id == $b->id ? $peminjaman->jumlah : 0) }}
                                </option>
                            @endforeach
                        </select>
                        {{-- Hidden input untuk simpan foto barang --}}
                        <input type="hidden" name="foto_barang" id="foto_barang" value="{{ old('foto_barang', $peminjaman->foto_barang) }}">

                        {{-- Preview foto barang --}}
                        <div class="mt-2">
                            <img id="previewBarang" 
                                 src="{{ $peminjaman->foto_barang ? asset('image/barang/'.$peminjaman->foto_barang) : asset('sneat/assets/img/avatars/1.png') }}" 
                                 alt="Foto Barang" 
                                 class="rounded" 
                                 width="100" height="100"
                                 style="object-fit:cover;">
                        </div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pegawaiSelect = document.getElementById('nama_pegawai');
    const fotoPegawaiInput = document.getElementById('foto_pegawai');
    const previewPegawai = document.getElementById('previewPegawai');

    const barangSelect = document.getElementById('barang_id');
    const fotoBarangInput = document.getElementById('foto_barang');
    const previewBarang = document.getElementById('previewBarang');

    // Pegawai
    pegawaiSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const foto = selected.getAttribute('data-foto');
        fotoPegawaiInput.value = foto;
        if (foto) {
            previewPegawai.src = `/image/pegawai/${foto}`;
        } else {
            previewPegawai.src = `/sneat/assets/img/avatars/1.png`;
        }
    });

    // Barang
    barangSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const foto = selected.getAttribute('data-foto');
        fotoBarangInput.value = foto;
        if (foto) {
            previewBarang.src = `/image/barang/${foto}`;
        } else {
            previewBarang.src = `/sneat/assets/img/avatars/1.png`;
        }
    });
});
</script>


@endsection
