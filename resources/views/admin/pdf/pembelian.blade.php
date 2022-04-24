<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembelian</title>
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
            <h1 style="margin-bottom: 5px">Laporan Penjualan</h1>
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
                        <th scope="col">Pembeli</th>
                        <th scope="col">Detail Pembelian</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalHarga = 0;
                    @endphp
                    @foreach ($rows as $key => $r)
                        <tr>
                            <th class="text-center align-middle">{{ $key = $key + 1 }}</th>
                            <td class="align-middle">
                                <b>{{ $r->nama_customer }}</b>
                                <br>
                                <code>CHCKID.{{ $r->checkout_id }}</code><br>
                                <code><b>Alamat : </b>{{ $r->alamat }}</code>
                            </td>
                            <td class="text-end">
                                <ul class="list-group">
                                    @php
                                        $totalHarga = 0;
                                    @endphp
                                    @foreach ($keranjangRows as $s)
                                        @if ($r->checkout_id == $s->checkout_id)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $s->nama_produk }}
                                                <span class="badge" style="color:black">Rp.
                                                    {{ number_format($s->harga) }}</span>
                                            </li>
                                            @php
                                                $totalHarga = $totalHarga + $s->harga;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $totalHarga = $totalHarga + $r->ongkir;
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Biaya Pengiriman <b>({{ strtoupper($r->kurir) }})</b>
                                        </span>
                                        <span class="badge" style="color:black">Rp.
                                            {{ number_format($r->ongkir) }}</span>

                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span><strong>Total Harga</strong></span>
                                        <span class="badge" style="color:black">Rp.
                                            {{ number_format($totalHarga) }}</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="align-middle text-center">
                                <br>
                                @if ($r->no_resi != null)
                                    @if ($r->no_resi == 'Ditolak oleh admin')
                                        <div
                                            style="background-color: rgb(189, 7, 7); padding: 5px; color:white; border-radius: 10px">
                                            {{ $r->no_resi }}
                                        </div>
                                    @else
                                        <div
                                            style="background-color: rgb(20, 189, 1); padding: 5px; color:white; border-radius: 10px">
                                            Diterima
                                            <br>
                                            No Resi. {{ $r->no_resi }}
                                        </div>
                                    @endif
                                @else
                                    <div
                                        style="background-color: rgb(251, 255, 0); padding: 5px; color:white; border-radius: 10px">
                                        Pesanan Proses, Resi Belum Terbit
                                    </div>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a href="/{{ $r->bukti_pembayaran }}" target="_blank"><img
                                        src="{{ $_SERVER['DOCUMENT_ROOT'] . '/' . $r->bukti_pembayaran }}"
                                        width="120px" alt=""></a>
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
