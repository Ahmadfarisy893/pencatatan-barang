<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Pegawai;
use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Variabel ini akan tersedia di semua blade view
        View::composer('*', function ($view) {
        $view->with('jumlahPegawai', Pegawai::count());
        $view->with('jumlahBarang', Barang::count());
        $view->with('jumlahPeminjaman', Peminjaman::count());
        $view->with('jumlahUser', User::count());
    });
    }
}
