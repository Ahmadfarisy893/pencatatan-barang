@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4 class="text-gray-900">Tambah Category</h4>
                </div>

                <form action="{{ route('categories.store') }}" method="POST" class="user">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="block font-medium mb-1">Category</label>
                        <input type="text" name="name" class="form-control form-control-user" placeholder="Masukkan nama category" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                         <button type="submit" class="btn btn-primary btn-user btn-block w-50">
                            Simpan Data
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-user btn-block">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
