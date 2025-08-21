<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berita Acara Serah Terima Barang</title>
    <style>
        @page { margin: 24mm 20mm; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12pt; line-height: 1.5; }
        h2 { text-align: center; margin: 0; }
        .nomor { text-align: center; margin-top: 2px; margin-bottom: 18px; }
        p { margin: 8px 0; }
        ol { margin: 0 0 8px 18px; }
        table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        .ttd { width: 100%; margin-top: 36px; text-align: center; border: none; }
        .ttd td { border: none; width: 50%; vertical-align: top; }
        .right { text-align: right; }
        .center { text-align: center; }
    </style>
</head>
<body>
    @php
        \Carbon\Carbon::setLocale('id');
        $tanggal = \Carbon\Carbon::parse($loan->tanggal_pemberian)->translatedFormat('d F Y');
        $hari    = \Carbon\Carbon::parse($loan->tanggal_pemberian)->translatedFormat('l');
    @endphp

    <h2>BERITA ACARA SERAH TERIMA BARANG</h2>
    <p class="nomor">Nomor: {{ $loan->nomor_dokumen ?? '—' }}</p>

    <p>Pada hari ini, {{ $hari }}, tanggal {{ $tanggal }}, bertempat di {{ config('app.name') }}, kami yang bertanda tangan di bawah ini:</p>

    <ol>
        <li>
            Nama : <b>{{ $loan->petugas_nama ?? '................................' }}</b><br>
            NIP  : {{ $loan->petugas_nip ?? '................................' }}<br>
            (Selanjutnya disebut <b>PIHAK PERTAMA</b>)
        </li>
        <br>
        <li>
            Nama : <b>{{ $loan->nama_pegawai }}</b><br>
            NIP  : {{ $loan->nip }}<br>
            (Selanjutnya disebut <b>PIHAK KEDUA</b>)
        </li>
    </ol>

    <p>Dengan ini menyatakan bahwa PIHAK PERTAMA telah menyerahkan kepada PIHAK KEDUA barang berikut:</p>

    <table>
        <thead>
            <tr>
                <th style="width:40px;">No</th>
                <th>Nama Barang</th>
                <th style="width:80px;">Jumlah</th>
                <th style="width:160px;">Jenis / Kategori</th>
                <th style="width:160px;">Tanggal Pemberian</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td>{{ optional($loan->barang)->nama_barang }}</td>
                <td class="center">{{ $loan->jumlah }}</td>
                <td>{{ optional(optional($loan->barang)->category)->name }}</td>
                <td>{{ \Carbon\Carbon::parse($loan->tanggal_pemberian)->format('d-m-Y') }}</td>
            </tr>
        </tbody>
    </table>

    <p>Barang tersebut telah diterima oleh PIHAK KEDUA dalam keadaan <b>baik dan lengkap</b>.</p>
    <p>Demikian berita acara serah terima barang ini dibuat dengan sebenar-benarnya untuk dipergunakan sebagaimana mestinya.</p>
    <br>
    <p class="right">Jakarta, {{ $tanggal }}</p>
    <br>
    <br>
    <br>
    <table width="100%" class="ttd">
    <tr>
        <td width="50%" align="center">PIHAK PERTAMA</td>
        <td width="50%" align="center">PIHAK KEDUA</td>
    </tr>
    <tr>
        <td height="80px"></td>
        <td></td>
    </tr>
    <tr>
        <td align="center">
            <b>{{ $loan->petugas_nama ?? '(Nama & NIP Petugas)' }}</b><br>
            NIP. {{ $loan->petugas_nip ?? '................' }}
        </td>
        <td align="center">
            <b>{{ $loan->nama_pegawai }}</b><br>
            NIP. {{ $loan->nip }}
        </td>
    </tr>
</table>
</body>
</html>
