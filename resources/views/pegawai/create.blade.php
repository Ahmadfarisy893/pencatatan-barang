@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4 class="text-gray-900">Tambah Pegawai</h4>
                </div>

                <form action="{{ route('pegawai.store') }}" method="POST" class="user" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control form-control-user" placeholder="NIP" required>
                        @error('nip')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama">Nama Pegawai</label>
                        <input type="text" name="nama" class="form-control form-control-user" placeholder="Nama Pegawai" required>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Foto Pegawai</label>
                        <input 
                            class="form-control" 
                            type="file" 
                            id="formFile" 
                            name="foto" 
                            accept="image/png, image/jpeg, image/jpg, image/gif, image/webp"
                            onchange="previewImage(event)" 
                        />

                        {{-- Tempat preview gambar --}}
                        <div class="mt-3 text-center">
                            <img id="preview" src="#" alt="Preview Foto" class="img-thumbnail d-none" width="200">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status_kerja" class="form-label">Status Kerja</label>
                        <select name="status_kerja" id="status_kerja" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Pensiun">Pensiun</option>
                            <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                         <button type="submit" class="btn btn-primary btn-user btn-block w-50">
                            Simpan Data
                        </button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-user btn-block">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- Script untuk preview gambar --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];

            if (!allowedTypes.includes(file.type)) {
                alert("Hanya file gambar (JPG, PNG, GIF, WEBP) yang diperbolehkan!");
                input.value = ""; // reset input file
                preview.classList.add('d-none');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
