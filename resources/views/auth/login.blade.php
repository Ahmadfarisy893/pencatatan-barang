@extends('auth.app')

@section('content')
<!--begin::Form-->
<form method="POST" action="{{ route('postLogin') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
@csrf
<!--begin::Heading-->
	<div class="text-center mb-10">
	    <!--begin::Link-->
	    <div class="text-gray-400 fw-bold fs-4">
            New Here?
            <a href="{{ route('register') }}" class="link-primary fw-bolder">Create an Account</a>
        </div>
	    <!--end::Link-->
	</div>
	<!--begin::Heading-->
	<!--begin::Input group-->
	 <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
        <input class="form-control form-control-lg form-control-solid" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your Email" required />
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
	<!--end::Input group-->
	<!--begin::Input group-->
	<div class="fv-row mb-10">
		<!--begin::Wrapper-->
	<div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">Password</label>
        <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Enter your Password" required />
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
	</div>
	<!--end::Input group-->
    <div class="fv-row mb-4">
        <label class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" />
            <span class="form-check-label">Remember me</span>
        </label>
    </div>
	<!--begin::Actions-->
	<div class="text-center">
		<!--begin::Submit button-->
		<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
			<span class="indicator-label">Continue</span>
			<span class="indicator-progress">Please wait...
			<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
		</button>
		<!--end::Submit button-->
		<!--begin::Separator-->
		<div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
		<!--end::Separator-->
		<!--begin::Google link-->
		<a href="{{ route('login.google') }}" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
		<img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-20px me-3" />Continue with Google</a>
		<!--end::Google link-->
	</div>
	<!--end::Actions-->
</form>
<!--end::Form-->
@endsection