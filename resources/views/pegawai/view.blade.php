@extends('layouts.index')

@section('content')
<div class="container-xxl flex-grow-1 ">
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <!-- Profile Info -->
        <div class="card-body">
          <h5 class=" fs-4">Profile Details</h5>
          <div class="d-flex align-items-start align-items-sm-center gap-2">
            <img
              src="{{ asset('sneat/assets/img/avatars/1.png') }}"
              alt="user-avatar"
              class="d-block rounded"
              height="100"
              width="100"
              id="uploadedAvatar"
            />
            <div>
              <h6 class="mb-1 fs-4 mx-2">Nama Karyawan</h6>
              <p class="mb-2 text-capitalize text-dark fw-semibold fs-4 mx-2">{{ $pegawai->nama }}</p>

              <h6 class="mb-1 fs-4 mx-2">NIP</h6>
              <p class="mb-0 text-muted fs-4 mx-2">{{ $pegawai->nip }}</p>
            </div>
          </div>
        </div>
        <!-- /Profile Info -->
      </div>
    </div>
  </div>
<!-- detail barang yang dipinjamkan -->
@forelse($peminjaman as $loan)
<div class="col-md-12 mb-3">
  <div class="card shadow-sm">
    <div class="row g-0 align-items-center">
      <div class="col-md-3">
        <img class="card-img"
             src="{{ asset('sneat/assets/img/elements/12.jpg') }}"
             alt="Gambar Barang"
             height="200"
             style="object-fit: cover;" />
      </div>
      <div class="col-md-9">
        <div class="card-body">
          <h5 class="card-title mb-1">{{ $loan->barang->nama_barang ?? '-' }}</h5>
          <p class="mb-1"><strong>Kode:</strong> {{ $loan->barang->kode_barang ?? '-' }}</p>
          <p class="mb-1"><strong>Kategori:</strong> {{ $loan->barang->category->name ?? '-' }}</p>
          <p class="mb-1"><strong>Jumlah:</strong> {{ $loan->jumlah }}</p>
          <p class="mb-1"><strong>Tanggal Pemberian:</strong> {{ \Carbon\Carbon::parse($loan->tanggal_pemberian)->format('d-m-Y') }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@empty
    <p class="text-muted">Tidak ada barang yang dipinjam pegawai ini.</p>
@endforelse
</div>
@endsection
