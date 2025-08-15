@extends('dashboard')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container m-0">
    <h1 class="mb-4">Data Peminjaman Barang</h1>

    <div class="d-flex justify-content-between align-items-center mt-5 mb-3 gap-8">
            <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <a href="{{ route('peminjaman.create') }}" class="btn btn-primary d-flex align-items-center" style="height: 50px;">
                    <i class="fas fa-plus me-2"></i> Tambah peminjaman
                </a>
        </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <table class="table table-bordered table-responsive table-hover align-middle text-center rounded-3 overflow-hidden">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Pegawai</th>
                    <th>Barang</th>
                    <th>Jenis / Kategori</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pemberian</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @forelse($peminjamans as $i => $loan)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $loan->nip }}</td>
                        <td>{{ $loan->nama_pegawai }}</td>
                        <td>{{ optional($loan->barang)->nama_barang }}</td>
                        <td>{{ optional(optional($loan->barang)->category)->name }}</td>
                        <td>{{ $loan->jumlah }}</td>
                        <td>{{ \Carbon\Carbon::parse($loan->tanggal_pemberian)->format('d-m-Y') }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('peminjaman.edit', $loan->id) }}" class="btn btn-sm btn-warning rounded-pill">Update</a>
                            <!--
                            <form action="{{ route('peminjaman.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin hapus peminjaman?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger rounded-pill">Hapus</button> -->
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
</div>

{{-- CSS khusus --}}
<style>
    /* Supaya sudut tabel melengkung */
    .table {
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.75rem; /* radius 12px */
        box-shadow: 1px 2px 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    tbody {
        background-color: #F8FAFC; /* Warna latar belakang tabel */
        color: #030303ff;
    }
    .highlight {
    background-color: yellow;
    padding: 2px 4px;
    border-radius: 3px;
    }
</style>
<script>
// Search
$(document).ready(function(){
    // Simpan isi asli semua cell saat halaman dimuat
    $("#myTable tr").each(function(){
        $(this).find("td").each(function(){
            $(this).attr("data-original", $(this).html());
        });
    });

    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        var found = false;

        // Reset isi cell dari data-original agar tombol kembali seperti semula
        $("#myTable tr").each(function(){
            $(this).find("td").each(function(){
                $(this).html($(this).attr("data-original"));
            });
        });

        // Filter baris
        $("#myTable tr").filter(function() {
            var rowText = $(this).text().toLowerCase();
            var match = rowText.indexOf(value) > -1;

            $(this).toggle(match);

            if (match && value !== "") {
                found = true;
                // Highlight hanya teks biasa (bukan tombol)
                $(this).find("td").each(function(){
                    if ($(this).find("a, button").length === 0) {
                        var cellText = $(this).text();
                        var regex = new RegExp("(" + value + ")", "gi");
                        $(this).html(cellText.replace(regex, "<span class='highlight'>$1</span>"));
                    }
                });
            } else if (match) {
                found = true;
            }
        });

        // Pesan "tidak ditemukan"
        if (!found && value !== "") {
            if ($("#noData").length === 0) {
                $("#myTable").append("<tr id='noData'><td colspan='7' class='text-center text-danger'>Data tidak ditemukan</td></tr>");
            }
        } else {
            $("#noData").remove();
        }
    });
});
</script>
@endsection
