@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <select name="role" id="role" class="form-control form-control-user" required>
            <option value="Super Admin" {{ old('role', $user->role ?? '') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
            <option value="Admin" {{ old('role', $user->role ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
             <button type="submit" class="btn btn-primary btn-user btn-block w-50">
                Simpan Data
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-user btn-block">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection