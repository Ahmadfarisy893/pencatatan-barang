@extends('layouts.index')

@section('content')
<style>
     @media (max-width: 768px) {
        #badges {
            width: 100%;
            font-size: 15px;
        }
        #role {
            font-size: 15px;
        }
        #user {
            font-size: 20px;
        }
        .row.cards-row {
            display: flex;
            flex-wrap: wrap;
        }
        .row.cards-row > .col-12 {
            width: 50%;
        }
     }
</style>
<div class="card">
  <div class="d-flex align-items-end row">
    <div class="col-sm-7">
      <div class="card-body">
        <h5 class="card-title text-primary" id="user">Congratulations  {{ Auth::user()->name }} 🎉</h5>
        <p class="mb-4" id="role">
          Role Anda: {{ Auth::user()->role }}
        </p>
      </div>
      </div>    
    <div class="col-sm-5 text-center text-sm-left">
      <div class="card-body pb-0 px-0 px-md-4">
        <img
          src="{{ asset('sneat/assets/img/illustrations/man-with-laptop-light.png') }}"
          height="140"
          alt="View Badge User"
          data-app-dark-img="illustrations/man-with-laptop-dark.png"
          data-app-light-img="illustrations/man-with-laptop-light.png"
        />
      </div>
    </div>
  </div>
</div>
<div class="col-lg-12 mt-4">
  <div class="row cards-row">
    <!-- Card 1 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100 text-center">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/person.png') }}" alt="Pegawai" class="rounded" height="50" />
            </div>
          <span class="fw-semibold d-block mb-1">Pegawai</span>
          <h3 class="card-title mb-1">{{ $jumlahPegawai }}</h3>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100 text-center">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/item.png') }}" alt="Credit Card" class="rounded" height="50"/>
            </div>
          <span>Barang</span>
          <h3 class="card-title text-nowrap mb-1">{{ $jumlahBarang }}</h3>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100 text-center">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/people.png') }}" alt="Credit Card" class="rounded" height="50"/>
            </div>
          <span>Peminjaman</span>
          <h3 class="card-title text-nowrap mb-1">{{ $jumlahPeminjaman }}</h3>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100 text-center">
        <div class="card-body d-flex flex-column align-items-center justify-content-center">
          <div class="avatar flex-shrink-0">
            <img src="{{ asset('sneat/assets/img/icons/unicons/users.png') }}" alt="Users" class="rounded" height="50" />
          </div>
          <span>Users</span>
          <h3 class="card-title text-nowrap mb-1">{{ $jumlahUser }}</h3>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection