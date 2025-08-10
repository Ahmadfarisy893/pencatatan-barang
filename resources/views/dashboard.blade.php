@extends('layouts.index')

@section('content')
<div class="card">
  <div class="d-flex align-items-end row">
    <div class="col-sm-7">
      <div class="card-body">
        <h5 class="card-title text-primary">Congratulations  {{ Auth::user()->name }} 🎉</h5>
          
        <p class="mb-4">
          You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
          your profile.
        </p>
        <a href="" class="btn btn-sm btn-primary">View Badges</a>
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
  <div class="row">
    <!-- Card 1 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" />
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">View More</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Profit</span>
          <h3 class="card-title mb-2">$12,628</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card" class="rounded" />
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">View More</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>
            </div>
          </div>
          <span>Sales</span>
          <h3 class="card-title text-nowrap mb-1">$4,679</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card" class="rounded" />
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">View More</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>
            </div>
          </div>
          <span>Sales</span>
          <h3 class="card-title text-nowrap mb-1">$4,679</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
        </div>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="col-lg-3 col-md-6 col-12 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ asset('sneat/assets/img/icons/unicons/wallet-info.png') }}" alt="Credit Card" class="rounded" />
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">View More</a>
                <a class="dropdown-item" href="#">Delete</a>
              </div>
            </div>
          </div>
          <span>Sales</span>
          <h3 class="card-title text-nowrap mb-1">$4,679</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection