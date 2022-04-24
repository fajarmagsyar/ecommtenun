@extends('user.layouts.main')
@section('content')

    @if (session()->has('success'))
        <script>
            swal("Berhasil", "{{ session('success') }}", "success")
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            swal("Gagal", "{{ session('error') }}", "error")
        </script>
    @endif
    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors mt-5">
        <div class="container">

            <div class="section-title">
                <h2>Catatan Pembelian
                </h2>
            </div>

            <div class="row">
                @if (count($keranjangRows) == 0)
                    <div class="col-lg-12">
                        <div class="member">
                            <div class="member-info">
                                <center class="mx-auto">
                                    Belum ada produk
                                </center>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-sm-8 mx-auto">
                        <div class="card shadow" style="border: none">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Checkout ID</th>
                                            <th class="text-center">Detail Barang</th>
                                            <th class="text-center">Resi Pengiriman</th>
                                        </tr>
                                        @php
                                            $jumlahHarga = 0;
                                        @endphp
                                        @foreach ($checkoutRows as $key => $r)
                                            <tr>
                                                <th class="text-center align-middle">{{ $key = $key + 1 }}</th>
                                                <td class="align-middle text-center">
                                                    <code>CHCKID.{{ $r->checkout_id }}</code>
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
                                                    @if ($r->no_resi != null)
                                                        @if ($r->no_resi == 'Ditolak oleh admin')
                                                            <span class="badge bg-danger">
                                                                {{ $r->no_resi }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-success">
                                                                Diterima :
                                                                <br>
                                                                No Resi. {{ $r->no_resi }}
                                                            </span>
                                                        @endif
                                                    @else
                                                        <span class="badge bg-warning">
                                                            No Resi Belum Terbit
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="https://api.whatsapp.com/send?phone=6281290381937&text=Keluhan%20No.%20Invoice:%20CHCKID.{{ $r->checkout_id }}%20|%20Keluhan%20anda:%20"
                                                        class="btn btn-success btn-sm" data-action="share/whatsapp/share"><i
                                                            class="fab fa-whatsapp"></i> Keluhan</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section><!-- End Doctors Section -->

    </main><!-- End #main -->
@endsection
