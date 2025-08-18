@extends('layouts.index')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container">
    <h1>Data User</h1> <!-- Ubah judul -->
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3 gap-8">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <a href="" class="btn btn-primary d-flex align-items-center" style="height: 50px;">
            <i class="fas fa-plus me-2"></i> Tambah User
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered table-striped table-responsive table-hover align-middle text-center rounded-3 overflow-hidden">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'Super Admin')
                            <span class="badge bg-light-primary text-primary">Super Admin</span>
                        @else
                            <span class="badge bg-light-success text-success">Admin</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="#" class="btn btn-sm btn-warning rounded-pill">
                            Update
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <ul id="pagination" class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
        <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
    </ul>
</div>

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

    .pagination .page-item.active .page-link {
    background-color: #2a83dcff;
    border-color: #2a83dcff;
    color: white;
    }
</style>
<!-- script search -->
<script>
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
<!-- Script untuk pagination -->
<script>
$(function(){
    const rowsPerPage = 5;
    const allRows = $("#myTable tr");
    const numbers = $("#pagination");

    // Simpan isi asli cell
    allRows.find("td").each(function(){
        $(this).attr("data-original", $(this).html());
    });

    // Fungsi tampilkan halaman
    function showPage(page, rows){
        const start = (page-1)*rowsPerPage, end = start+rowsPerPage;
        allRows.hide(); rows.hide().slice(start,end).show();

        $(".page-item").removeClass("active");
        $(".page-num").filter((_,el)=>$(el).text()==page).parent().addClass("active");

        numbers.data({current:page, rows});
    }

    // Buat pagination
    function renderPagination(rows){
        const count = rows.length, pages = Math.ceil(count/rowsPerPage);
        numbers.empty(); $("#noData").remove();

        if(!count){
            $("#myTable").append("<tr id='noData'><td colspan='7' class='text-center text-danger'>Data tidak ditemukan</td></tr>");
            return;
        }

        numbers.append(`<li class="page-item"><a class="page-link nav-btn" data-dir="-1" href="#">Previous</a></li>`);
        for(let i=1;i<=pages;i++) numbers.append(`<li class="page-item"><a class="page-link page-num" href="#">${i}</a></li>`);
        numbers.append(`<li class="page-item"><a class="page-link nav-btn" data-dir="1" href="#">Next</a></li>`);

        showPage(1, rows);
    }

    // Pagination click
    numbers.on("click",".page-num, .nav-btn",function(e){
        e.preventDefault();
        const {current, rows} = numbers.data(), pages = Math.ceil(rows.length/rowsPerPage);
        let page = $(this).hasClass("page-num") ? parseInt($(this).text()) : current + +$(this).data("dir");
        if(page>=1 && page<=pages) showPage(page, rows);
    });

    // Search
    $("#myInput").on("keyup",function(){
        const val = $(this).val().toLowerCase();
        allRows.each(function(){
            $(this).find("td").each(function(){
                $(this).html($(this).attr("data-original"));
            });
        });

        const filtered = allRows.filter(function(){
            const text = $(this).text().toLowerCase(), match = text.includes(val);
            if(match && val) $(this).find("td").each(function(){
                if(!$(this).find("a,button").length){
                    $(this).html($(this).text().replace(new RegExp(`(${val})`,"gi"),"<span class='highlight'>$1</span>"));
                }
            });
            return match;
        });

        renderPagination(filtered);
    });

    // Init pertama
    renderPagination(allRows);
});
</script>

@endsection