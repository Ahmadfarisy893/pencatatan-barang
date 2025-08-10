@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center ">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h4>Edit Category</h4>
                </div>
                <form action="{{ route('categories.update', $categories->id) }}" method="POST" class="user mt-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $categories->name }}" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
                        <button type="submit" class="btn btn-success btn-user w-50">
                            Update Data
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-user">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
