@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4>Edit Data Pegawai</h4>
                </div>
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" class="user mt-4" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" class="form-control" value="{{ $pegawai->nip }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $pegawai->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Update Foto Pegawai</label>
                            <input 
                                class="form-control" 
                                type="file" 
                                id="formFile" 
                                name="foto" 
                                accept="image/png, image/jpeg, image/jpg, image/gif, image/webp"
                                onchange="previewImage(event)" 
                            />
    
                            {{-- Preview foto lama --}}
                            <div class="mt-3 text-center">
                                @if($pegawai->foto)
                                    <img id="preview" src="{{ asset('image/pegawai/' . $pegawai->foto) }}" alt="Foto Pegawai" class="img-thumbnail" width="200">
                                @else
                                    <img id="preview" src="#" alt="Preview Foto" class="img-thumbnail d-none" width="200">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $pegawai->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status_kerja" class="form-label">Status Kerja</label>
                            <select name="status_kerja" id="status_kerja" class="form-control">
                                <option value="Aktif" {{ old('status_kerja', $pegawai->status_kerja ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Pensiun" {{ old('status_kerja', $pegawai->status_kerja ?? '') == 'Pensiun' ? 'selected' : '' }}>Pensiun</option>
                                <option value="Mengundurkan Diri" {{ old('status_kerja', $pegawai->status_kerja ?? '') == 'Mengundurkan Diri' ? 'selected' : '' }}>Mengundurkan Diri</option>
                            </select>
                        </div>
                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <button type="submit" class="btn btn-success btn-user w-50">
                            Update Data
                        </button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary btn-user">
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
