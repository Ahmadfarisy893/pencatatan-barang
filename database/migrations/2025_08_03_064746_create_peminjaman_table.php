<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
             $table->increments('id');

            // Data pegawai
            $table->string('nip');
            $table->string('nama_pegawai');

            // Barang yang dipinjam
            $table->unsignedInteger('barang_id');
            $table->integer('jumlah');

            // Tanggal pemberian / peminjaman
            $table->date('tanggal_pemberian');

            $table->timestamps();

            $table->foreign('barang_id')
                  ->references('id')->on('barang')
                  ->onDelete('restrict'); // jangan hapus barang kalau dipakai, sesuaikan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
