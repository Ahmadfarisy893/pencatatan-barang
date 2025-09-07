@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4 class="text-gray-900">Tambah Peminjaman Barang</h4>
                </div>

                <form action="{{ route('peminjaman.store') }}" method="POST" class="user" enctype="multipart/form-data">
                    @csrf

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
                        <label for="nama_pegawai" class="block font-medium mb-1">Nama Pegawai</label>
                        <select name="nama_pegawai" id="nama_pegawai" class="form-control form-control-user" required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach($pegawais as $p)
                                <option value="{{ $p->nama }}" data-nip="{{ $p->nip }}" data-foto="{{ $p->foto }}" {{ old('nama_pegawai') == $p->nama ? 'selected' : '' }}>
                                    {{ $p->nama }} 
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- NIP Pegawai (Auto-filled) -->
                    <div class="form-group mb-3">
                        <label for="nip" class="block font-medium mb-1">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control form-control-user" value="{{ old('nip') }}" readonly required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="block font-medium mb-1">Foto Pegawai</label><br>
                        <img id="preview_foto" src="" alt="Foto Pegawai" style="max-height:120px; display:none;" class="rounded shadow">
                        <input type="hidden" name="foto_pegawai" id="foto_pegawai" value="{{ old('foto_pegawai') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="barang_id" class="block font-medium mb-1">Barang</label>
                        <select name="barang_id" id="barang_id" class="form-control form-control-user" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $b)
                                <option value="{{ $b->id }}" data-foto="{{ $b->foto }}" {{ old('barang_id') == $b->id ? 'selected' : '' }}>
                                    {{ $b->nama_barang }} ({{ optional($b->category)->name }}) — Stok: {{ $b->jumlah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="block font-medium mb-1">Foto barang</label><br>
                        <img id="preview_foto_barang" src="" alt="Foto barang" style="max-height:120px; display:none;" class="rounded shadow">
                        <input type="hidden" name="foto_barang" id="foto_barang" value="{{ old('foto_barang') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="jumlah" class="block font-medium mb-1">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control form-control-user" value="{{ old('jumlah', 1) }}" min="1" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_pemberian" class="block font-medium mb-1">Tanggal Pemberian</label>
                        <input type="date" name="tanggal_pemberian" class="form-control form-control-user" value="{{ old('tanggal_pemberian', now()->toDateString()) }}" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-user w-50">
                            Simpan
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
document.addEventListener("DOMContentLoaded", function () {
    // === Pegawai ===
    const selectPegawai = document.getElementById("nama_pegawai");
    const nipField = document.getElementById("nip");
    const fotoPegawaiField = document.getElementById("foto_pegawai");
    const previewFotoPegawai = document.getElementById("preview_foto");

    selectPegawai.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        const nip = selectedOption.getAttribute("data-nip");
        const foto = selectedOption.getAttribute("data-foto");

        nipField.value = nip || "";
        fotoPegawaiField.value = foto || "";

        if (foto) {
            previewFotoPegawai.src = "/image/pegawai/" + foto;
            previewFotoPegawai.style.display = "block";
        } else {
            previewFotoPegawai.style.display = "none";
        }
    });

    // === Barang ===
    const selectBarang = document.getElementById("barang_id");
    const fotoBarangField = document.getElementById("foto_barang");
    const previewFotoBarang = document.getElementById("preview_foto_barang");

    selectBarang.addEventListener("change", function () {
        const selectedOption = this.options[this.selectedIndex];
        const fotoBarang = selectedOption.getAttribute("data-foto");

        fotoBarangField.value = fotoBarang || "";

        if (fotoBarang) {
            previewFotoBarang.src = "/image/barang/" + fotoBarang; // sesuaikan path folder
            previewFotoBarang.style.display = "block";
        } else {
            previewFotoBarang.style.display = "none";
        }
    });
});
</script>


@endsection
