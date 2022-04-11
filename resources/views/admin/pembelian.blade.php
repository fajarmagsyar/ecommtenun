@extends('admin.layouts.main')
@section('content')
    @if (session()->has('success'))
        <script>
            swal("Berhasil", "{{ session('success') }}", "success")
        </script>
    @endif
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pembelian</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/admin/dashboard"
                            style="color: black; text-decoration:none">Admin</a></li>
                    <li class="breadcrumb-item active">Pembelian</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Pembelian
                    </div>

                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Pembeli</th>
                                    <th class="text-center">Detail Barang</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Bukti Pembayaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama Pembeli</th>
                                    <th class="text-center">Detail Barang</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Bukti Pembayaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $jumlahHarga = 0;
                                @endphp
                                @foreach ($checkoutRows as $key => $r)
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
                                            <br>
                                            @if ($r->no_resi != null)
                                                <span class="badge bg-primary">
                                                    No Resi. {{ $r->no_resi }}
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Pesanan Proses, Resi Belum Terbit
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="/{{ $r->bukti_pembayaran }}" target="_blank"><img
                                                    src="/{{ $r->bukti_pembayaran }}" width="120px" alt=""></a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form action="/admin/pembelian/deletePemesanan" method="post">
                                                @csrf
                                                <input type="hidden" name="checkout_id" value="{{ $r->checkout_id }}">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#ubah{{ $r->checkout_id }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-check"></i>
                                                </a>
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    style="padding-right: 11px; padding-left: 11px"
                                                    onclick="return confirm('Apakah anda yakin ingin menolak pesanan ini?')"><i
                                                        class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                                    {{-- MODAL RESI --}}
                                    <div class="modal fade" id="ubah{{ $r->checkout_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- FORM Pengisian --}}
                                                    <form action="/admin/pembelian/updateResi" method="post">
                                                        @method('post')
                                                        @csrf
                                                        <input type="hidden" value="{{ $r->email }}" name="email">
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Nomor
                                                                Resi</label>
                                                            <input type="hidden" name="checkout_id"
                                                                value="{{ $r->checkout_id }}">
                                                            <input type="text" class="form-control" name="no_resi"
                                                                required>
                                                            <span class="text-muted small">*Pastikan no resi yang anda
                                                                inputkan sudah benar</span>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="reset" class="btn btn-secondary"><i
                                                            class="fa fa-undo"></i>
                                                        Reset</button>
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-save"></i>
                                                        Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </main>
    @endsection
