<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>{{ config('app.name') }} - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Global Stylesheets Bundle -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
     <style>

</style>
</head>
<body>
     <div id="app" class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-primary text-white d-flex flex-column p-4" style="min-width: 250px; height: 100vh;">
    <!-- App Name -->
    <div class="mb-5 text-center">
        <h4 class="m-0 text-white" style="font-size: 20px;">{{ config('app.name', 'Laravel') }}</h4>
    </div>

    <!-- Sidebar Menu -->
    <ul class="nav flex-column gap-3">
        <li class="nav-item fs-4">
            <a class="nav-link text-white d-flex align-items-center" href="{{ url('/dashboard') }}">
                <i class="fas fa-tachometer-alt me-3 text-white" style="width: 20px; font-size:20px;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item fs-4">
            <a class="nav-link text-white d-flex align-items-center" href="{{ url('/pegawai') }}">
                <i class="fas fa-user-plus me-3 text-white" style="width: 20px; font-size:20px;"></i>
                <span>Tambah Pegawai</span>
            </a>
        </li>
        <li class="nav-item fs-4">
            <a class="nav-link text-white d-flex align-items-center" href="{{ url('/barang') }}">
                <i class="fas fa-boxes me-3 text-white" style="width: 20px; font-size:20px;"></i>
                <span>Barang</span>
            </a>
        </li>
        <li class="nav-item fs-4">
            <a class="nav-link text-white d-flex align-items-center" href="{{ url('/categories') }}">
                <i class="fas fa-tags me-3 text-white" style="width: 20px; font-size:20px;"></i>
                <span>Categories</span>
            </a>
        </li>
        <li class="nav-item fs-4">
            <a class="nav-link text-white d-flex align-items-center" href="{{ url('/peminjaman') }}">
                <i class="fas fa-info-circle me-3 text-white" style="width: 20px; font-size:20px;"></i>
                <span>Peminjaman</span>
            </a>
        </li>
        <li class="nav-item fs-4">
            <a class="nav-link text-white d-flex align-items-center" href="{{ url('/laporan') }}">
                <i class="fas fa-file-alt me-3 text-white" style="width: 20px; font-size:20px;"></i>
                <span>Berita Acara</span>
            </a>
        </li>
        {{-- menu Users hanya untuk Super Admin --}}
         @if(Auth::user()->role === 'Super Admin')
             <li class="nav-item fs-4">
                 <a class="nav-link text-white d-flex align-items-center" href="{{ url('/users') }}">
                     <i class="fas fa-users me-3 text-white"></i>
                     <span>Users</span>
                 </a>
             </li>
         @endif
    </ul>
</nav>


        <!-- Main content -->
<div class="flex-grow-1">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Dashboard Link -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
                Dashboard
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <!-- Guest Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    {{ __('Login') }}
                                </a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-2"></i>
                                    {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    @else
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown d-flex align-items-center">
                        <li class="nav-item d-flex align-items-center me-3">
                            <a href="{{ url('/mail/welcome-email') }}" class="nav-link position-relative" title="Gmail">
                                <i class="fas fa-envelope text-white" style="font-size: 18px;"></i>
                                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle gmail-badge" style="font-size: 10px;">0</span>
                            </a>
                        </li>
                        <!-- Gmail Icon -->

                        <!-- Profile Dropdown -->
                        <a id="navbarDropdown" class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <span class="ms-2">{{ Auth::user()->name }}</span>
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mx-2" style="width: 32px; height: 32px;">
                                <span class="text-white fw-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="fas fa-user me-2"></i>
                                Profile
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="fas fa-cog me-2"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
        <main class="py-4 px-4">
            @yield('content')
        </main>
    </div>

</div>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>