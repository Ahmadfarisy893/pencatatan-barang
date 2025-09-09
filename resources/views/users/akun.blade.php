@extends('dashboard')

@section('content')
<div class="container d-flex justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow mb-4">
      <div class="card-body p-5">
        
        <h4 class="mb-4">My Account</h4>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('users.updateAkun') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Avatar -->
          <div class="d-flex align-items-center mb-4">
            <img
              src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('/sneat/assets/img/avatars/1.png') }}"
              alt="user-avatar"
              class="rounded me-3"
              height="100"
              width="100"
              style="object-fit: cover;"
            />
            <div>
              <label for="avatar" class="btn btn-primary me-2 mb-2">
                <i class="bx bx-upload"></i> Upload new photo
              </label>
              <input type="file" id="avatar" name="avatar" hidden accept="image/*">
              <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800KB</p>
            </div>
          </div>

          <hr>

          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ auth()->user()->name }}" required>
          </div>

          <!-- NIP -->
          <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip"
                   value="{{ auth()->user()->nip }}" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ auth()->user()->email }}" required>
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-user">
              Kembali
            </a>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection
