<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Produk</title>
</head>
<style>
    @page {
        size: A4;
        margin: 0;
        size: landscape;
        orientation: landscape;
        margin: 50px;
    }

    body {
        font-size: 11px;
        font-family: Arial, Helvetica, sans-serif;
    }

    table {
        border-collapse: collapse;
    }

    tr,
    th,
    td {
        border: 1px solid rgb(79, 79, 79);
    }

    th,
    td {
        padding: 5px
    }

</style>

<body>
    <div>
        <center>
            <img src="{{ $_SERVER['DOCUMENT_ROOT'] }}/user/assets/img/logo.png" style="width: 100px"
                alt="'Gambar tidak ditemukan'" alt="Tidak ada gambar">
        </center>
    </div>
    <div class="container">
        <center>
            <h1 style="margin-bottom: 5px">Laporan Produk</h1>
            <span>Dicetak: {{ date('Y-m-d') }}</span>
        </center>
    </div>
    <div class="container mt-5">
        <center>
            <h3 class="mb-3">- Respon -</h4>
        </center>

        @if (count($rows) > 0)
            <table class="table table-bordered mb-5" style="margin-left: auto; margin-right: auto">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalHarga = 0;
                    @endphp
                    @foreach ($rows as $key => $r)
                        <tr>
                            <th class="text-center align-middle">{{ $key = $key + 1 }}</th>
                            <td class="align-middle">{{ $r->nama_produk }}</td>
                            <td class="align-middle">{{ $r->kategori_id }}</td>
                            <td class="align-middle">{{ number_format($r->harga) }}</td>
                            <td class="align-middle">{{ $r->deskripsi }}</td>
                            <td class="align-middle text-center">
                                <a href="/{{ $r->bukti_pembayaran }}" target="_blank"><img
                                        src="{{ $_SERVER['DOCUMENT_ROOT'] . '/' . $r->foto }}" width="120px"
                                        alt=""></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <center>
                <div
                    style="background-color:rgb(159, 0, 0); border-radius: 10px;color: white; padding: 5px; width: 150; margin-left: auto; margin-right: auto">
                    Belum ada respon oleh TPF
                </div>
            </center>
        @endif
    </div>
</body>

</html>
