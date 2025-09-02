@extends('layouts.index')

@section('content')
<div class="container-xxl flex-grow-1 ">
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <!-- Barang Info -->
        <div class="card-body">
          <h5 class=" fs-4">Detail Barang</h5>
          <div class="d-flex align-items-start align-items-sm-center gap-2">
            <img
              src="{{ asset('image/barang/' . $barang->foto) }}"
              alt="barang-image"
              class="d-block rounded"
              height="100"
              width="100"
              style="object-fit: cover;"
            />
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-1 fs-4 mx-2">Nama Barang</h6>
                <p class="mb-2 text-capitalize text-dark fw-semibold fs-4 mx-2">{{ $barang->nama_barang }}</p>
              </div>

              <div class="col-md-6">
                <h6 class="mb-1 fs-4 mx-2">Kode Barang</h6>
                <p class="mb-0 text-capitalize fs-4 mx-2">{{ $barang->kode_barang }}</p>
              </div>

              <div class="col-md-6 mt-2">
                <h6 class="mb-1 fs-4 mx-2">Kategori</h6>
                <p class="mb-0 text-capitalize fs-4 mx-2">{{ $barang->category->name ?? '-' }}</p>
              </div>

              <div class="col-md-6 mt-2">
                <h6 class="mb-1 fs-4 mx-2">Total Dipinjam Oleh</h6>
                <p class="mb-0 text-dark fw-semibold fs-4 mx-2">{{ $barang->peminjaman->count() }} Pegawai</p>
              </div>
            </div>
          </div>
        </div>
        <!-- /Barang Info -->
      </div>
    </div>
  </div>

  <!-- Detail pegawai yang meminjam barang ini -->
  @forelse($barang->peminjaman as $loan)
  <div class="col-md-12 mb-3">
    <div class="card shadow-sm">
      <div class="row g-0 align-items-center">
        <div class="col-md-3">
          <img class="card-img"
               src=""
               alt="Foto Pegawai"
               height="200"
               style="object-fit: cover;" />
        </div>
        <div class="col-md-9">
          <div class="card-body">
            <h5 class="card-title mb-1"><strong>Nama:</strong> {{ $loan->nama_pegawai ?? '-' }}</h5>
            <p class="mb-1"><strong>NIP:</strong> {{ $loan->nip ?? '-' }}</p>
            <p class="mb-1"><strong>Status Kerja:</strong> {{ $loan->status_kerja ?? '-' }}</p>
            <p class="mb-1"><strong>Jumlah Dipinjam:</strong> {{ $loan->jumlah }}</p>
            <p class="mb-1"><strong>Tanggal Pemberian:</strong> {{ \Carbon\Carbon::parse($loan->tanggal_pemberian)->format('d-m-Y') }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @empty
      <p class="text-muted">Belum ada pegawai yang meminjam barang ini.</p>
  @endforelse
</div>
@endsection
