@extends('admin.layouts.main')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Tenun Ikat Gunung Mako Mama Syariat</li>
                </ol>
                <div class="row">
                    <div class="col-xl-10 mx-auto">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Jumlah Penjualan Tahun {{ date('Y') }}
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Pesanan Terbaru <a href="/admin/pembelian" style="font-size: 12px">Lihat Selengkapnya <i
                                class=" fas fa-chevron-right"></i></a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Pembeli</th>
                                    <th class="text-center">Detail Barang</th>
                                    <th class="text-center">Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Pembeli</th>
                                    <th class="text-center">Detail Barang</th>
                                    <th class="text-center">Bukti Pembayaran</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $jumlahHarga = 0;
                                @endphp
                                @foreach ($pesananTerbaru as $key => $r)
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
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Biaya Pengiriman <b>({{ strtoupper($r->kurir) }})</b>
                                                    </span>
                                                    <span class="badge" style="color:black">Rp.
                                                        {{ number_format($r->ongkir) }}</span>

                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span><strong>Total Harga</strong></span>
                                                    <span class="badge" style="color:black">Rp.
                                                        {{ number_format($totalHarga) }}</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="/{{ $r->bukti_pembayaran }}" target="_blank"><img
                                                    src="/{{ $r->bukti_pembayaran }}" width="120px" alt=""></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

        <script>
            Chart.defaults.global.defaultFontFamily =
                '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = "#292b2c";

            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [
                        "Januari",
                        "Februari",
                        "Maret",
                        "April",
                        "Mei",
                        "Juni",
                        "Juli",
                        "Agustus",
                        "September",
                        "Oktober",
                        "November",
                        "Desember",
                    ],
                    datasets: [{
                        label: "Jumlah Penjualan",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: <?php

echo '[';
foreach ($jumlahTahunan as $r) {
    echo $r . ',';
}
echo ']';
?>,
                    }, ],
                },
                options: {
                    scales: {
                        xAxes: [{
                            time: {
                                unit: "month",
                            },
                            gridLines: {
                                display: false,
                            },
                        }, ],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                maxTicksLimit: 5,
                            },
                            gridLines: {
                                display: true,
                            },
                        }, ],
                    },
                    legend: {
                        display: true,
                    },
                },
            });
        </script>
    @endsection
