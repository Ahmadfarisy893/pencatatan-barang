@extends('auth.app')

@section('content')
<form method="POST" action="{{ route('register') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
    @csrf

    <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Name</label>
        <input class="form-control form-control-lg form-control-solid" type="text" name="name" value="{{ old('name') }}" placeholder="Enter your Name" required autofocus />
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
        <input class="form-control form-control-lg form-control-solid" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your Email" required />
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Password</label>
        <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Enter your Password" required />
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Confirm Password</label>
        <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" placeholder="Confirm your Password" required />
    </div>

    <div class="d-grid mb-5">
        <button type="submit" class="btn btn-lg btn-primary w-100">
            Register
        </button>
    </div>
    <div class="text-center mb-10">
	    <!--begin::Link-->
	    <div class="text-gray-400 fw-bold fs-4">
            Already have an account?
            <a href="{{ route('login') }}" class="link-primary fw-bolder">Log-in</a>
        </div>
	    <!--end::Link-->
	</div>
</form>
@endsection