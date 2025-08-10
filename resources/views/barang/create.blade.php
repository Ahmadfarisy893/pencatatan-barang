@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4 class="text-gray-900">Tambah Barang</h4>
                </div>

                <form action="{{ route('barang.store') }}" method="POST" class="user">
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
                        <label for="category_id" class="block font-medium mb-1">Kategori</label>
                        <select name="category_id" id="category_id" class="form-control form-control-user" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_barang" class="block font-medium mb-1">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control form-control-user"
                               placeholder="Masukkan nama barang" value="{{ old('nama_barang') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="kode_barang" class="block font-medium mb-1">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control form-control-user"
                               placeholder="Masukkan kode barang" value="{{ old('kode_barang') }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jumlah" class="block font-medium mb-1">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control form-control-user"
                               placeholder="0" value="{{ old('jumlah', 0) }}" min="0" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="kondisi" class="block font-medium mb-1">Kondisi</label>
                        <select name="kondisi" id="kondisi" class="form-control form-control-user" required>
                            <option value="baik" {{ old('kondisi', 'baik') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="perlu perbaikan" {{ old('kondisi') == 'perlu perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-user w-50">
                            Simpan Data
                        </button>
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-user">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
