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
    <table class="table table-bordered table-striped table-responsive table-hover align-middle text-center rounded-3 overflow-hidden">
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
                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-sm btn-warning rounded-pill">Update</a>
                    <!--<form action="{{ route('categories.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>-->
                </td>
           </tr>
           @endforeach
        </tbody>
    </table>
</div>

<style>
    /* Supaya sudut tabel melengkung */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.75rem; /* radius 12px */
        box-shadow: 1px 2px 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    tbody {
        background-color: #F8FAFC; /* Warna latar belakang tabel */
        color: #030303ff;
    }

   
</style>
@endsection