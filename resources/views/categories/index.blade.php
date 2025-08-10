@extends('dashboard')

@section('content')
<div class="container">
    <h1>Category Barang</h1>
        <div class="d-flex justify-content-between align-items-center mt-5 mb-3 ">
            <h4 class="mb-0">Category</h4>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Tambah category
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
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($categories as $index=> $item)
           <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
           </tr>
           @endforeach
        </tbody>
    </table>
</div>
@endsection